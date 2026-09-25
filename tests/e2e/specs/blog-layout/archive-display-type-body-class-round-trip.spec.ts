import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'spacious_archive_display_type';

/**
 * @area    content
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     `spacious_archive_display_type` is the control named in
 *          .themegrill-qa/knowledge.md's data-model section
 *          (`inc/customizer/options/content/**`, cross-referenced against
 *          `get_theme_mod` keys) that governs the blog/archive/search
 *          listing layout. `blog_medium_alternate` is the one choice among
 *          its four whose effect is a single, unambiguous `body` class
 *          rather than a template-file swap (see the sibling spec in this
 *          directory for the template-swap leg) — making it the cheap,
 *          reliable round-trip target for this control, the same reasoning
 *          `site-layout-body-class-round-trip.spec.ts` already applies to
 *          `spacious_site_layout`.
 *
 * `spacious_archive_display_type` is a `radio` control, default `blog_large`
 * (inc/customizer/options/content/class-spacious-customize-blog-archive-options.php:49-62),
 * with choices `blog_large` / `blog_medium` / `blog_medium_alternate` /
 * `blog_full_content`. `spacious_body_class()` (inc/functions.php:229-235)
 * reads it directly, independent of the per-post-type layout branch above it:
 *
 *   if ( get_theme_mod( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
 *     $classes[] = 'blog-alternate-medium';
 *   }
 *   if ( get_theme_mod( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
 *     $classes[] = 'blog-medium';
 *   }
 *
 * Neither `blog_large` (the default) nor `blog_full_content` adds any class
 * here — only `blog_medium` and `blog_medium_alternate` do — so this spec
 * sets the control to `blog_medium_alternate` and asserts the front end's
 * `<body>` carries `blog-alternate-medium`, then confirms it is gone once
 * reverted to the default.
 *
 * Checked on `/` rather than a specific archive: `spacious_body_class()` is a
 * `body_class` filter with no `is_home()`/`is_archive()` guard around this
 * particular condition, so it applies uniformly to any page — the front
 * page (this suite's default Reading Settings) is the cheapest one already
 * known to render without seeding any content.
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet. Written from inc/functions.php read in full, not from an
 * observed toggle.
 */
test('Content > Blog Posts display type persists a body class through publish and reopen @fresh @content', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
  const testValue = 'blog_medium_alternate';
  const expectedBodyClass = 'blog-alternate-medium';

  try {
    await customizer.setControl(CONTROL_ID, testValue);

    // Leg 1 (of 2 automated) — published, hard-reloaded front end.
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const bodyClass = (await page.locator('body').getAttribute('class')) ?? '';
    expect(bodyClass.split(/\s+/)).toContain(expectedBodyClass);

    // Leg 2 — reopened Customizer shows the persisted value, not the old one.
    await customizer.open({ control: CONTROL_ID });
    const reopened = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
    expect(reopened).toBe(testValue);
  } finally {
    // Published, not just set: on Playground the fixture's own MySQL-based
    // restore (customizer.ts / theme-mods-snapshot.ts) is a no-op, so this
    // publish is what actually reverts the live, persisted value there.
    try {
      await customizer.setControl(CONTROL_ID, original);
      await customizer.publish();
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
