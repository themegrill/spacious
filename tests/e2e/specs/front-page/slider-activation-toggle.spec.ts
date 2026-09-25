import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'spacious_activate_slider';

/**
 * @area    front-page
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     Spacious ships no `front-page.php` template at all (confirmed:
 *          `ls *.php` at the theme root lists no such file) — the front page
 *          is whatever `home.php`/`index.php` render for the site's Reading
 *          Settings, same as any other blog listing. The one genuinely
 *          front-page-specific mechanism in source is the featured image
 *          slider: a Customizer panel (`spacious_slider_options`,
 *          inc/customizer/class-spacious-customizer-register-sections-panels.php)
 *          whose activation control is checked directly by `header.php`
 *          before deciding whether to render the slider markup at all. This
 *          spec guards that on/off gate, not the slider's carousel behaviour
 *          (jQuery Cycle2, out of scope for a static-DOM assertion).
 *
 * `spacious_activate_slider` is a `checkbox` control, default `0`
 * (inc/customizer/options/slider/class-spacious-customize-slider-options.php:48-59).
 * `header.php:209-219` reads it directly:
 *
 *   if ( get_theme_mod( 'spacious_activate_slider', '0' ) == '1' ) {
 *     if ( get_theme_mod( 'spacious_blog_slider', '0' ) != '1' ) {
 *       if ( is_home() || is_front_page() ) { spacious_featured_image_slider(); }
 *     } else { if ( is_front_page() ) { spacious_featured_image_slider(); } }
 *   }
 *
 * `spacious_blog_slider` defaults to `0`, so with both controls left at
 * their defaults the outer `is_home() || is_front_page()` branch is the one
 * that applies — true for this suite's target site, whose Reading Settings
 * are the WordPress default ("Your latest posts" on `/`, i.e. `/` is both
 * `is_home()` and `is_front_page()`).
 *
 * `spacious_featured_image_slider()` (inc/header-functions.php:156-222)
 * always emits `<section id="featured-slider">` once called — the per-slide
 * `.slides` divs inside it are individually gated on slide content being
 * configured (`spacious_slider_title`/`_text`/`_image`, header-functions.php:170),
 * but the wrapping `#featured-slider` section itself is not, so this spec
 * does not need to configure any slide content to observe the toggle's
 * effect — `#featured-slider`'s mere presence/absence on `/` is exactly what
 * the checkbox controls.
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet (.themegrill-qa/knowledge.md's front matter). Written from
 * header.php and inc/header-functions.php read in full, not from an
 * observed toggle.
 */
test('Slider > Activate slider shows and hides #featured-slider on the front page @fresh @front-page', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);

  try {
    await customizer.setControl(CONTROL_ID, true);
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    await expect(
      page.locator('#featured-slider'),
      'Expected #featured-slider to render on the front page once spacious_activate_slider is on',
    ).toBeVisible();

    // setControl() drives window.wp.customize() in the CURRENT page — the
    // goto() above navigated away from the Customizer entirely, so it must
    // be reopened before the next setControl() call has anything to act on.
    await customizer.open({ control: CONTROL_ID });
    await customizer.setControl(CONTROL_ID, false);
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    await expect(
      page.locator('#featured-slider'),
      'Expected #featured-slider to be gone from the front page once spacious_activate_slider is off again',
    ).toHaveCount(0);
  } finally {
    // Courtesy-only revert for a reused browser context — the fixture's own
    // teardown (see customizer.ts / theme-mods-snapshot.ts) is the real
    // safety net and restores the true DB value regardless of how this test
    // exits. Published, not just set: on Playground the fixture's own
    // teardown is a no-op (no MySQL there), so this publish is the only
    // thing that actually reverts the live, persisted value on that tier.
    try {
      await customizer.open({ control: CONTROL_ID });
      await customizer.setControl(CONTROL_ID, original);
      await customizer.publish();
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
