import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'spacious_primary_color';

/**
 * @area    global
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     A setting can fail publish-reaches-the-front-end or
 *          still-set-on-reopen while looking fine in the other leg. The
 *          Customizer round-trip (options → theme_mods → rendered output) is
 *          named in .themegrill-qa/knowledge.md's "Critical flows" as the
 *          theme's single most fix-commit-touched area (32 touches on the
 *          pre-split inc/customizer.php across the mined commit window),
 *          which is why a permanent guard on at least one representative
 *          control is worth having.
 *
 * `spacious_primary_color` is registered as a `spacious-color` control in
 * `inc/customizer/options/global/class-spacious-customize-colors-options.php`
 * (default `#0FBE7C`) and consumed by `Spacious_Dynamic_CSS::render_output()`
 * (inc/class-spacious-dynamic-css.php:38), which writes the colour, verbatim
 * and lower-cased through `esc_html()`, into dozens of CSS rules (link/hover
 * colours, button backgrounds, the menu-toggle hover state, etc.). That CSS
 * is registered as an inline block on the theme's own stylesheet handle via
 * `wp_add_inline_style( 'spacious_style', $theme_dynamic_css )`
 * (inc/enqueue-scripts.php:92 — the `light` skin path; `spacious_color_skin`
 * defaults to `light`), which WordPress prints with the id
 * `spacious_style-inline-css`. That id, and the presence of the literal hex
 * value inside it, is what this spec asserts on the published front end.
 *
 * This automates two of the three legs — published-front-end and
 * reopened-Customizer-shows-the-persisted-value — not the live-preview leg.
 * See fixtures/customizer.ts's docblock on `setControl` for why: Spacious's
 * controls are plain WP_Customize_Control subclasses (not a React-rendered
 * system), so there is no known ColorMag-style Customind re-render gap, but
 * that has not been confirmed against a live Spacious site either, so this
 * spec does not claim it.
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet (.themegrill-qa/knowledge.md's front matter says as much for the
 * whole file). This spec is written from source only; a human running it for
 * the first time against a real site is the confirmation this docblock is
 * missing.
 */
test('Global > Colors > Primary Color persists through publish and reopen @fresh @global', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
  const testColor = '#ff00aa';

  try {
    await customizer.setControl(CONTROL_ID, testColor);

    // Leg 1 (of 2 automated) — published, hard-reloaded front end (a fresh
    // page load, not the preview iframe).
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const frontCss = await page.evaluate(
      () => document.getElementById('spacious_style-inline-css')?.textContent ?? '',
    );
    expect(frontCss.toLowerCase()).toContain(testColor);

    // Leg 2 — reopened Customizer shows the persisted value, not the old one.
    await customizer.open({ control: CONTROL_ID });
    const reopened = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
    expect(String(reopened).toLowerCase()).toBe(testColor);
  } finally {
    // Courtesy-only revert for a reused browser context — the fixture's own
    // teardown (see customizer.ts / theme-mods-snapshot.ts) is the real
    // safety net and restores the true DB value regardless of how this test
    // exits.
    try {
      await customizer.setControl(CONTROL_ID, original);
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
