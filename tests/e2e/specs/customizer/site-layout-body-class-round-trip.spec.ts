import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'spacious_site_layout';

/**
 * @area    global
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     Site Layout is one of the very few Spacious controls whose effect
 *          is a single, unambiguous `body` class rather than an inline CSS
 *          rule buried in a dynamic stylesheet — making it a cheap, reliable
 *          round-trip target independent of the Primary Color spec's
 *          mechanism. .themegrill-qa/knowledge.md's "Known-fragile areas"
 *          table separately names this exact breakpoint pair ("Layout at
 *          ~978px") as fixed on three separate readme.txt-documented
 *          occasions, which is why this control specifically (not some other
 *          radio control) is worth a permanent guard.
 *
 * `spacious_site_layout` is a plain `radio` control
 * (inc/customizer/options/global/class-spacious-customize-layout-options.php,
 * default `box_1218px`) with four choices: `box_1218px`, `box_978px`,
 * `wide_1218px`, `wide_978px`. `spacious_body_class()`
 * (inc/functions.php:237-245) reads it and appends exactly one of four body
 * classes: `wide-978`, `narrow-978`, `wide-1218`, or `narrow-1218` (the
 * default `box_1218px` maps to `narrow-1218`, the `else` branch). This spec
 * sets the control to `wide_978px` and asserts the front end's `<body>`
 * carries `wide-978` and not the default `narrow-1218`.
 *
 * Automates the same two legs as the Primary Color spec (published front end
 * + reopened-Customizer-shows-persisted-value), for the same reason — see
 * that spec's docblock and fixtures/customizer.ts for why the live-preview
 * leg is not asserted here either.
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet. Written from source only (inc/functions.php:237-245 read in
 * full to confirm the exact class strings above); a human running this for
 * the first time against a real site is the confirmation this docblock is
 * missing.
 */
test('Global > Layout > Site Layout persists through publish and reopen @fresh @global', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
  const testLayout = 'wide_978px';
  const expectedBodyClass = 'wide-978';

  try {
    await customizer.setControl(CONTROL_ID, testLayout);

    // Leg 1 (of 2 automated) — published, hard-reloaded front end.
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const bodyClass = (await page.locator('body').getAttribute('class')) ?? '';
    expect(bodyClass.split(/\s+/)).toContain(expectedBodyClass);

    // Leg 2 — reopened Customizer shows the persisted value, not the old one.
    await customizer.open({ control: CONTROL_ID });
    const reopened = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
    expect(reopened).toBe(testLayout);
  } finally {
    try {
      await customizer.setControl(CONTROL_ID, original);
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
