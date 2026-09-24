import { test, expect } from '../../fixtures/customizer';

/**
 * @area    woocommerce
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     .themegrill-qa/knowledge.md lists a real WooCommerce compat layer
 *          (inc/customizer/options/woocommerce/**, inc/functions.php,
 *          inc/header-functions.php) but flags it "not exercised this
 *          draft — no live WooCommerce site available", the same
 *          uncertainty this run is under (whether the plugin is active on
 *          this target is not knowable ahead of time). Grepping the compat
 *          files found their actual gate is a file-level
 *          `class_exists( 'WooCommerce' )` bail-out — testable in BOTH
 *          states without assuming which one this run is in, by checking
 *          which state it's actually in first.
 *
 * `inc/customizer/options/woocommerce/class-spacious-customize-woocommerce-sidebar-options.php:20-22`
 * (identically at `class-spacious-customize-woocommerce-design-options.php:20`,
 * per the same grep):
 *
 *   if ( ! class_exists( 'WooCommerce' ) ) {
 *     return;
 *   }
 *
 * — the whole file returns before its class (and so its
 * `register_options()` call, which is what would add
 * `spacious_woo_archive_layout`/`spacious_woo_product_layout` to the
 * Customizer) is even defined. This spec detects whether WooCommerce is
 * active via its own REST namespace (`wc/v3`, present in the `GET /wp-json/`
 * index only when the plugin registers its REST controllers) and, on a site
 * where it is NOT active, asserts `spacious_woo_archive_layout` is not a
 * registered `wp.customize()` setting at all. It deliberately does NOT
 * assert the converse (that the setting IS registered when WooCommerce IS
 * active) — this run's target may or may not have WooCommerce active, and
 * only one of the two branches is knowable without a live WooCommerce
 * session to confirm the other; skipping the untestable branch is honest,
 * asserting it from source alone would not be.
 *
 * NOT verified live — no live WooCommerce site has been used with this
 * theme yet (.themegrill-qa/knowledge.md's own words for this compat layer).
 * Written from the two options files' file-level guard, not from an
 * observed Customizer panel.
 */
test('WooCommerce customizer options are absent when WooCommerce is not active @fresh @woocommerce', async ({
  page,
  customizer,
}) => {
  test.setTimeout(60_000);

  const rootRes = await page.request.get('/wp-json/');
  const root = await rootRes.json();
  const wooActive = Array.isArray(root?.namespaces) && root.namespaces.includes('wc/v3');

  test.skip(
    wooActive,
    'WooCommerce is active on this target — this spec only guards the class_exists(\'WooCommerce\') ' +
      'bail-out that applies when the plugin is ABSENT (see this spec\'s docblock for why the converse ' +
      'is not asserted here).',
  );

  await customizer.open();
  const registered = await page.evaluate(
    () => typeof (window as any).wp.customize('spacious_woo_archive_layout') !== 'undefined',
  );

  expect(
    registered,
    'spacious_woo_archive_layout should not be a registered Customizer setting when WooCommerce is not ' +
      "active — its options file returns before defining the class that would register it",
  ).toBe(false);
});
