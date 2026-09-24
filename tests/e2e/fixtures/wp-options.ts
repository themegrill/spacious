import { spawn } from 'child_process';
import { test as base } from './wp-admin';
import { connectionArgs, readDbConfig, type DbConfig } from './theme-mods-snapshot';
import { hasMysql } from '../env';

/**
 * Direct `wp_options` read/write/delete, for specs that need to flip a
 * PHP-level `get_option()` gate that has no REST endpoint and no Customizer
 * control — e.g. `inc/demo-import-migration.php`'s
 * `themegrill_demo_importer_activated_id` check (that option is written by
 * the separate ThemeGrill Demo Importer plugin during a real import, not by
 * anything this theme's own REST surface exposes), or the site's `WPLANG`
 * option, which is what actually decides `is_rtl()`.
 *
 * `local` env only — same restriction as theme-mods-snapshot.ts's DB
 * helpers, and for the same reason: there is no `mysql` binary (and nothing
 * to protect) on a disposable Playground runner. This fixture does NOT
 * skip on a spec's behalf — every method throws plainly if called without
 * `hasMysql()` — because the reason a particular spec needs this belongs in
 * that spec's own `test.skip(!hasMysql(), playgroundSkipReason('...'))`
 * call, worded for what THAT spec is guarding, not a generic fixture message.
 *
 * `runMysql()` below is a deliberate near-duplicate of
 * theme-mods-snapshot.ts's own private (unexported) helper of the same
 * name and shape, not an import of it: that module exports the pieces this
 * one composes differently (`readDbConfig`/`connectionArgs`) but keeps its
 * stdin-piping runner private, and this pass's rule is to only ADD files,
 * not modify one already in place (see the 5 existing spec files) just to
 * export one more of its internals.
 */

export type WpOptionsHelper = {
  /** Reads one `wp_options` row, or `null` if it does not exist. */
  get: (name: string) => Promise<string | null>;
  /** Inserts or overwrites one `wp_options` row (`autoload` = 'no'). */
  set: (name: string, value: string) => Promise<void>;
  /** Removes one `wp_options` row. A no-op if it was never set. */
  delete: (name: string) => Promise<void>;
};

function runMysql(config: DbConfig, sql: string): Promise<string> {
  const args = [...connectionArgs(config), '-u', config.user, '-N', '-B'];
  if (config.password) args.push(`-p${config.password}`);
  args.push(config.database);

  return new Promise((resolve, reject) => {
    const child = spawn(config.mysqlBin, args, { stdio: ['pipe', 'pipe', 'pipe'] });
    let stdout = '';
    let stderr = '';
    child.stdout.on('data', (d) => (stdout += d));
    child.stderr.on('data', (d) => (stderr += d));
    child.on('error', reject);
    child.on('close', (code) => {
      if (stderr && !/using a password/i.test(stderr)) {
        console.warn(`wp-options: mysql reported: ${stderr.trim()}`);
      }
      if (code !== 0) {
        reject(new Error(`mysql exited with code ${code}: ${stderr.trim()}`));
        return;
      }
      resolve(stdout.trim());
    });
    child.stdin.end(sql);
  });
}

/**
 * Only `[a-zA-Z0-9_]` is accepted for an option NAME (never the value, which
 * always travels through base64 below). Every option this fixture is
 * actually used for (`themegrill_demo_importer_activated_id`,
 * `spacious_demo_import_migration_notice_dismiss`, `WPLANG`) already fits
 * that pattern; this is a deliberately narrow allowlist rather than a
 * general-purpose escaping routine, since a hand-written SQL string is the
 * one place that trade-off matters.
 */
function assertSafeOptionName(name: string): string {
  if (!/^[a-zA-Z0-9_]+$/.test(name)) {
    throw new Error(
      `wp-options: refusing option name "${name}" — only [a-zA-Z0-9_] is accepted here, ` +
        'to keep this a hand-authored SQL literal safe without a full escaping routine.',
    );
  }
  return name;
}

export const test = base.extend<{ wpOptions: WpOptionsHelper }>({
  // eslint-disable-next-line no-empty-pattern
  wpOptions: async ({}, use) => {
    let config: DbConfig | null = null;
    const cfg = () => (config ??= readDbConfig());

    const requireMysql = (method: string) => {
      if (!hasMysql()) {
        throw new Error(
          `wpOptions.${method}() was called without MySQL access on this target. Guard the call site ` +
            "with test.skip(!hasMysql(), playgroundSkipReason('...')) first — see env.ts.",
        );
      }
    };

    const helper: WpOptionsHelper = {
      get: async (name) => {
        requireMysql('get');
        const safe = assertSafeOptionName(name);
        const out = await runMysql(
          cfg(),
          `SELECT TO_BASE64(option_value) FROM ${cfg().tablePrefix}options WHERE option_name='${safe}';`,
        );
        return out ? Buffer.from(out, 'base64').toString('utf8') : null;
      },

      set: async (name, value) => {
        requireMysql('set');
        const safe = assertSafeOptionName(name);
        const base64 = Buffer.from(value, 'utf8').toString('base64');
        await runMysql(
          cfg(),
          `INSERT INTO ${cfg().tablePrefix}options (option_name, option_value, autoload) ` +
            `VALUES ('${safe}', FROM_BASE64('${base64}'), 'no') ` +
            `ON DUPLICATE KEY UPDATE option_value = FROM_BASE64('${base64}');`,
        );
      },

      delete: async (name) => {
        requireMysql('delete');
        const safe = assertSafeOptionName(name);
        await runMysql(cfg(), `DELETE FROM ${cfg().tablePrefix}options WHERE option_name='${safe}';`);
      },
    };

    await use(helper);
  },
});

export { expect } from '@playwright/test';
