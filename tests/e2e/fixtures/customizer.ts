import { test as base } from './wp-admin';
import type { Page } from '@playwright/test';
import { restoreThemeMods } from './theme-mods-snapshot';

type CustomizerHelper = {
  /**
   * Opens the Customizer, optionally auto-focused on a control and/or
   * previewing a specific front-end URL. `autofocus[control]=...&url=...` is
   * a core WordPress Customizer query-string convention, not a Spacious one
   * — it works regardless of which theme is active, and is the most
   * reliable way to land directly on the right panel instead of clicking
   * through the Customizer's nested accordion UI by hand.
   */
  open: (opts?: { control?: string; url?: string }) => Promise<void>;

  /**
   * Sets a control's value via `wp.customize(id).set(value)` in the
   * Customizer's top-level window, rather than driving the rendered control
   * widget directly. This only updates the live preview — nothing is
   * persisted until publish() is called, so most specs never need a revert
   * step at all.
   *
   * Spacious's controls (inc/customizer/core/custom-controls/**) are plain
   * PHP `WP_Customize_Control` subclasses rendered with core Customizer JS,
   * not a React-driven system like ColorMag's Customind — so there is no
   * known equivalent of Customind's "wp.customize().set() doesn't reliably
   * trigger the framework's own re-render" gap documented in that suite.
   * That said, no live session has exercised this fixture against a real
   * Spacious site yet (see .themegrill-qa/knowledge.md's front matter): this
   * assumption is unverified, not confirmed, and the specs that use this
   * fixture deliberately assert only the publish-then-reload and
   * reopen-shows-persisted-value legs, not the live-preview leg, until that
   * changes.
   */
  setControl: (id: string, value: unknown) => Promise<void>;

  /** frameLocator for the live preview iframe (`#customize-preview`). */
  previewFrame: () => ReturnType<Page['frameLocator']>;

  /**
   * Clicks Publish and waits for the save round-trip to finish. Only needed
   * by specs that must assert against a real (non-iframe) page load — e.g.
   * checking front-end HTML output rather than the preview. Pair with a
   * matching setControl() call restoring the original value in the test's
   * own cleanup step (a courtesy only — the fixture's own teardown below is
   * the real safety net).
   */
  publish: () => Promise<void>;
};

export const test = base.extend<{ customizer: CustomizerHelper }>({
  customizer: async ({ page }, use) => {
    const helper: CustomizerHelper = {
      open: async (opts = {}) => {
        const params = new URLSearchParams();
        if (opts.control) params.set('autofocus[control]', opts.control);
        params.set('url', opts.url ?? '/');

        await page.goto(`/wp-admin/customize.php?${params.toString()}`);

        // wp.customize() isn't available until the Customizer JS finishes
        // bootstrapping — polling for it is more robust than waiting on any
        // specific control's DOM node, since different control types render
        // different markup shapes (see inc/customizer/core/custom-controls/**).
        await page.waitForFunction(() => Boolean((window as any).wp?.customize), null, {
          timeout: 20_000,
        });
        await page.frameLocator('#customize-preview iframe').locator('body').waitFor();
      },

      setControl: async (id, value) => {
        await page.evaluate(
          ([controlId, controlValue]) => {
            (window as any).wp.customize(controlId as string).set(controlValue);
          },
          [id, value] as const,
        );
        // Let the postMessage round-trip to the preview iframe settle.
        await page.waitForTimeout(300);
      },

      previewFrame: () => page.frameLocator('#customize-preview iframe'),

      publish: async () => {
        // Nothing to save is a normal state, not a failure, and it must be
        // detected BEFORE clicking. WordPress disables #save and relabels it
        // "Published" when the changeset is clean, so clicking it in that
        // state would wait on a permanently-disabled button and the
        // customize_save response would never arrive. This can happen for
        // real: an interrupted earlier run can leave a control's test value
        // already published, so the next run's setControl() to that same
        // value is a no-op and publish() would otherwise hang for its whole
        // timeout. Answered from wp.customize's own saved state rather than
        // the button's disabled attribute or a fixed wait, for the same
        // reason ColorMag's identical fixture does — WordPress core, not
        // Spacious, owns this state machine.
        const alreadySaved = await page.evaluate(
          () => (window as any).wp?.customize?.state?.('saved')?.get() === true,
        );
        if (alreadySaved) return;

        const saved = page.waitForResponse(
          (r) =>
            r.url().includes('admin-ajax.php') &&
            r.status() === 200 &&
            (r.request().postData() ?? '').includes('customize_save'),
        );
        await page.click('#save');
        await saved;

        await page.waitForFunction(
          () => (window as any).wp?.customize?.state?.('saved')?.get() === true,
          null,
          { timeout: 15_000 },
        );
      },
    };

    await use(helper);

    // Runs after every test that requests this fixture, regardless of
    // pass/fail/timeout — a per-spec try/finally revert can't make that
    // guarantee (a test that times out mid-`finally` skips the rest of it; a
    // test that throws before reaching its own cleanup skips all of it), and
    // a customizer spec that fails after publish() but before its own revert
    // otherwise leaves the live site mutated for whatever spec happens to run
    // next. See theme-mods-snapshot.ts's docblock for the mechanism.
    await restoreThemeMods();
  },
});

export { expect } from '@playwright/test';
