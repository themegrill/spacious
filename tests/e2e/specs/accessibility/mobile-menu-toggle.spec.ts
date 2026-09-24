import { test, expect } from '../../fixtures/content';

const NARROW_VIEWPORT = { width: 390, height: 844 };

/**
 * @area    accessibility
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     js/navigation.js is named in .themegrill-qa/knowledge.md's
 *          "Known-fragile areas" table (11 fix-commit touches — "mobile/menu
 *          navigation logic"), and the mobile menu / submenu toggle is
 *          separately called out there as fixed repeatedly across unrelated
 *          releases per readme.txt's changelog. The open/close toggle itself
 *          — the mechanism every one of those fixes sits on top of — has no
 *          existing automated coverage, so this is the base case worth
 *          guarding permanently before any of the more specific submenu-
 *          positioning fixes.
 *
 * Read js/navigation.js in full to confirm the actual mechanism before
 * asserting anything about it, rather than assuming ColorMag's
 * `aria-expanded`/off-canvas pattern applies here — it does not. Spacious's
 * toggle (`js/navigation.js`, first IIFE) is a plain class swap with no ARIA
 * attribute at all:
 *
 *   button.onclick = function () {
 *     if ( container.className contains 'main-small-navigation' )
 *       replace it with 'main-navigation'   // closes
 *     else
 *       replace 'main-navigation' with 'main-small-navigation'  // opens
 *   };
 *
 * `#site-navigation` (inc/header-functions.php:339, `spacious_main_nav()`)
 * renders with class `main-navigation` by default. The CSS that makes this
 * meaningful lives in the `@media screen and (max-width: 768px)` block
 * (style.css:3320 onward): `.site-header .menu-toggle { display: block; }`
 * and `.main-navigation ul { display: none; }` — so under 768px the menu is
 * hidden and the toggle is visible until the container's class flips to
 * `main-small-navigation`, at which point the `.main-navigation ul` rule no
 * longer matches and the (unstyled-away) `<ul>` reverts to its normal
 * display. This spec asserts exactly that class flip and the resulting
 * visibility change, in both directions.
 *
 * Does NOT assert anything about `aria-expanded` or Escape-key handling:
 * neither exists in this code today (no ARIA attribute is ever set, and the
 * file's only keyboard handling — a jQuery `mouseover`/`touchstart` submenu-
 * repositioning fix — has no `keyup`/`keydown` listener of any kind). Stating
 * that is factual, not a claim that either should exist; asserting a
 * behaviour this file doesn't implement would just be an invented test.
 *
 * NOT verified live — no live session has exercised a mobile viewport against
 * a real Spacious site yet. Written from js/navigation.js and style.css read
 * in full, not from an observed click.
 */
test('mobile menu toggle opens and closes the primary nav @fresh @accessibility', async ({ page, content }) => {
  const menu = await content.aMenuWithDropdown();

  await page.setViewportSize(NARROW_VIEWPORT);
  await page.goto('/');

  const nav = page.locator('#site-navigation');
  const toggle = nav.locator('.menu-toggle').first();
  // The child link's own text is unambiguous evidence of the seeded menu,
  // rather than asserting against the whole <ul>'s bounding box.
  const childLink = nav.getByRole('link', { name: menu.childLabel, exact: true });

  // Closed by default: main-navigation, menu hidden under the 768px breakpoint.
  await expect(nav).toHaveClass(/(^|\s)main-navigation(\s|$)/);
  await expect(nav).not.toHaveClass(/main-small-navigation/);
  await expect(childLink).toBeHidden();

  await toggle.click();

  // Open: navigation.js's onclick replaced the class, exposing the menu.
  await expect(nav).toHaveClass(/main-small-navigation/);
  await expect(nav).not.toHaveClass(/(^|\s)main-navigation(\s|$)/);
  await expect(childLink).toBeVisible();

  await toggle.click();

  // Closed again: same handler, same replace, run in the other direction.
  await expect(nav).toHaveClass(/(^|\s)main-navigation(\s|$)/);
  await expect(nav).not.toHaveClass(/main-small-navigation/);
  await expect(childLink).toBeHidden();
});
