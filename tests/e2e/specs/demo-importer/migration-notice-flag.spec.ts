import { test, expect } from '../../fixtures/wp-options';
import { hasMysql, playgroundSkipReason } from '../../env';

const ACTIVATED_OPTION = 'themegrill_demo_importer_activated_id';
const DISMISS_OPTION = 'spacious_demo_import_migration_notice_dismiss';

/**
 * @area    demo-import
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     .themegrill-qa/knowledge.md names inc/demo-import-migration.php as
 *          a critical flow but flags it as "not exercised this draft" and
 *          warns a real demo import is lossy/risky to run against an
 *          existing site — exactly the kind of thing this suite avoids
 *          running for real (see fixtures/content.ts's docblock on why
 *          @fresh content is seeded via REST instead of a demo import).
 *          Reading the file found its actual gate is a PLAIN get_option()
 *          check, not anything the ThemeGrill Demo Importer plugin's own UI
 *          has to run to produce — so this spec sets that option directly
 *          and observes the effect, without importing anything or needing
 *          that separate plugin installed at all. This is the "gate on an
 *          option you can set directly" case, not the "only a full import
 *          exercises this" case — kept @fresh, not @demo, on that basis.
 *
 * `spacious_demo_import_migration_notice()` (inc/demo-import-migration.php:18-53)
 * renders `.demo-import-migrate-notice` on `admin_notices` when BOTH:
 *
 *   $demo_imported  = get_option( 'themegrill_demo_importer_activated_id' );  // :19
 *   $notice_dismiss = get_option( 'spacious_demo_import_migration_notice_dismiss' );  // :20
 *   if ( ! $notice_dismiss ) :                                                // :22
 *     if ( $demo_imported && ( strpos( $demo_imported, 'spacious' ) !== false ) ) :  // :24
 *
 * — i.e. the activated-demo-importer option's value must literally contain
 * the substring "spacious" (a real demo slug from ThemeGrill's own catalogue
 * would, e.g. "spacious-agency"), and the dismiss option must not be set.
 * This spec sets the first option directly and clears the second, confirms
 * the notice appears with its "Fix Imported Demo" button
 * (demo-import-migration.php:40), then sets the dismiss option and confirms
 * it disappears — exercising both branches of that same `if` without ever
 * touching the separate demo-importer plugin's own UI.
 *
 * DB-level only (`hasMysql()`): neither option is REST-exposed or has any
 * Settings-API registration this suite could reach through wp-admin's UI or
 * the REST API — see fixtures/wp-options.ts's docblock for why this needs
 * direct `wp_options` access, gated to `local` the same way
 * theme-mods-snapshot.ts's DB helpers are.
 *
 * NOT verified live — no live WordPress admin session has exercised this
 * notice yet. Written from inc/demo-import-migration.php read in full, not
 * from an observed notice.
 */
test('demo-import migration notice appears when the flag is set and clears once dismissed @fresh @demo-import', async ({
  page,
  wpOptions,
}) => {
  test.skip(
    !hasMysql(),
    playgroundSkipReason(
      'inc/demo-import-migration.php gates on two plain wp_options rows with no REST or UI surface',
    ),
  );
  test.setTimeout(60_000);

  const originalActivated = await wpOptions.get(ACTIVATED_OPTION);
  const originalDismiss = await wpOptions.get(DISMISS_OPTION);

  try {
    await wpOptions.delete(DISMISS_OPTION);
    await wpOptions.set(ACTIVATED_OPTION, 'spacious-e2e-test-demo');

    await page.goto('/wp-admin/index.php');
    const notice = page.locator('.demo-import-migrate-notice');
    await expect(
      notice,
      'Expected the demo-import migration notice once themegrill_demo_importer_activated_id contains ' +
        '"spacious" and the dismiss option is unset',
    ).toBeVisible();
    await expect(notice).toContainText('Fix Imported Demo');

    await wpOptions.set(DISMISS_OPTION, '1');
    await page.goto('/wp-admin/index.php');
    await expect(
      page.locator('.demo-import-migrate-notice'),
      'Expected the notice to be gone once spacious_demo_import_migration_notice_dismiss is set',
    ).toHaveCount(0);
  } finally {
    try {
      if (originalActivated === null) {
        await wpOptions.delete(ACTIVATED_OPTION);
      } else {
        await wpOptions.set(ACTIVATED_OPTION, originalActivated);
      }
    } catch (err) {
      console.warn(`Could not restore ${ACTIVATED_OPTION}:`, err);
    }
    try {
      if (originalDismiss === null) {
        await wpOptions.delete(DISMISS_OPTION);
      } else {
        await wpOptions.set(DISMISS_OPTION, originalDismiss);
      }
    } catch (err) {
      console.warn(`Could not restore ${DISMISS_OPTION}:`, err);
    }
  }
});
