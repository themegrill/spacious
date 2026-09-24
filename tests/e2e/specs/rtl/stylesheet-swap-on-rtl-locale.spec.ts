import { test, expect } from '../../fixtures/wp-options';
import { hasMysql, playgroundSkipReason } from '../../env';

const LOCALE_OPTION = 'WPLANG';
const RTL_LOCALE = 'ar'; // Arabic — core WordPress ships this as RTL.

/**
 * @area    rtl
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     .themegrill-qa/knowledge.md's "Known-fragile areas" table names
 *          style-rtl.css (13 fix-commit touches) and says plainly "RTL has
 *          no test coverage in this draft". Grepping the theme for
 *          `is_rtl`/`style-rtl` directly found ZERO matches in any .php
 *          file — style-rtl.css is never referenced by name anywhere in
 *          this theme's PHP. The actual mechanism is WordPress core's own
 *          RTL-swap convention, invoked (not reimplemented) by this theme.
 *
 * `inc/enqueue-scripts.php:66-67`:
 *
 *   wp_enqueue_style( 'spacious_style', get_stylesheet_uri() );
 *   wp_style_add_data( 'spacious_style', 'rtl', 'replace' );
 *
 * `wp_style_add_data( $handle, 'rtl', 'replace' )` is core WordPress
 * (`WP_Styles::do_item()`): when `is_rtl()` is true, core swaps the
 * enqueued `spacious_style` handle's src for the same path with `-rtl`
 * inserted before `.css` — i.e. `style-rtl.css` in place of `style.css` —
 * entirely inside core, before this theme's own code runs again. There is
 * no theme-side `if ( is_rtl() )` branch to find; the theme only declares
 * the swap via this one `wp_style_add_data()` call, matching the knowledge
 * file's grep finding.
 *
 * `is_rtl()` itself is driven by the SITE'S LOADED LOCALE having "rtl" as
 * its text direction, which in turn depends on that locale's translation
 * files actually being installed — not just an option value. This spec
 * flips the `WPLANG` option directly (there is no REST/Settings-API
 * surface for it) to an RTL locale and checks core's OWN signal that the
 * flip took effect — `<html dir="rtl">`, from core's `language_attributes()`,
 * called by `header.php:12/15/18` — before asserting anything about the
 * stylesheet. If the flip did not take effect (most likely: no RTL
 * language pack installed on this target), this reports that plainly and
 * skips, rather than asserting a swap that never had a chance to happen —
 * see the note below on what a green run here does and does not prove.
 *
 * A pass here confirms the ENQUEUE MECHANISM, not that style-rtl.css itself
 * renders correctly — this suite has no visual-diff tooling to compare it
 * against style.css's actual layout.
 *
 * NOT verified live — no live RTL session has been run against this theme,
 * and this environment's language-pack availability is unknown ahead of
 * time. Written from inc/enqueue-scripts.php and WordPress core's own
 * documented `wp_style_add_data()` behaviour, not from an observed swap.
 */
test('the main stylesheet swaps to style-rtl.css once the site locale is RTL @fresh @rtl', async ({
  page,
  wpOptions,
}) => {
  test.skip(
    !hasMysql(),
    playgroundSkipReason('Flipping the site locale needs a direct WPLANG wp_options write'),
  );
  test.setTimeout(60_000);

  const originalLocale = await wpOptions.get(LOCALE_OPTION);

  try {
    await wpOptions.set(LOCALE_OPTION, RTL_LOCALE);
    await page.goto('/?e2e-cache-bust=' + Date.now());

    const dir = await page.locator('html').getAttribute('dir');
    test.skip(
      dir !== 'rtl',
      `Setting WPLANG=${RTL_LOCALE} did not flip is_rtl() (<html dir="${dir}">) — the ${RTL_LOCALE} ` +
        'language pack is most likely not installed on this target, so the RTL enqueue path cannot be ' +
        'exercised here. This is an environment limitation, not a theme finding.',
    );

    const styleHref = await page.evaluate(
      () => (document.getElementById('spacious_style-css') as HTMLLinkElement | null)?.href ?? null,
    );
    expect(
      styleHref,
      'Expected the spacious_style-css <link> to exist on the front end',
    ).not.toBeNull();
    expect(
      styleHref,
      `Expected spacious_style-css to point at style-rtl.css once is_rtl() is true, got: ${styleHref}`,
    ).toMatch(/style-rtl\.css/);
  } finally {
    try {
      if (originalLocale === null) {
        await wpOptions.delete(LOCALE_OPTION);
      } else {
        await wpOptions.set(LOCALE_OPTION, originalLocale);
      }
    } catch (err) {
      console.warn(`Could not restore ${LOCALE_OPTION}:`, err);
    }
  }
});
