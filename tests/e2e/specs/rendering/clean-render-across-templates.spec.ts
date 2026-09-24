import { test, expect } from '../../fixtures/content';

/**
 * The negative test: before asserting anything a control does, assert that
 * every template type renders cleanly on its own — no PHP notice/warning/
 * deprecation leaking into the HTML, no raw shortcode text. This is the check
 * that would have caught a fatal on activation and is cheap enough to run on
 * every PR.
 *
 * Every path is resolved at run time from whatever the site actually has,
 * seeded if absent (see fixtures/content.ts) — never a hardcoded slug or
 * dated permalink from a particular demo import, which would degrade this
 * spec into "does this URL 404" the moment that content is gone.
 *
 * The 404 case keeps a literal path, because a URL that resolves to nothing
 * is exactly what it needs, and it asserts the status code explicitly —
 * which is also what stops the other five silently degrading into 404
 * checks.
 */

/**
 * @area    activation
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     A PHP notice or an unparsed shortcode reaching the DOM is the
 *          cheapest catastrophic regression to catch and the easiest to ship
 *          unnoticed. Runs across every template type because Spacious's
 *          header/footer chrome (header.php, footer.php) wraps all of them
 *          and a fatal in that chrome only shows up on whichever template
 *          happens to exercise it. No theme-registered shortcodes exist
 *          (grep of `add_shortcode` across the theme: zero matches, per
 *          .themegrill-qa/knowledge.md's "Frontend surfaces" section), so a
 *          raw `[shortcode]` string reaching the page would specifically
 *          indicate a plugin-provided shortcode failing to resolve.
 */
test('front page renders with no PHP notice and no raw shortcode text @fresh @activation', async ({ page }) => {
  await assertCleanRender(page, '/', 'front page');
});

/**
 * @area    activation
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     archive.php is a distinct template from single.php/page.php, with
 *          its own loop via content.php/content-blog-*.php. Resolved to a
 *          category that actually has posts — an empty archive renders a
 *          different branch (no-results.php) and would not exercise the
 *          loop at all.
 */
test('category archive renders with no PHP notice and no raw shortcode text @fresh @activation', async ({
  page,
  content,
}) => {
  const category = await content.aPopulatedCategory();
  await assertCleanRender(page, category.link, `category archive (${category.name})`);
});

/**
 * @area    activation
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     single.php pulls in content-single.php, which renders post meta,
 *          the layout-meta-box override (spacious_page_layout post meta,
 *          inc/admin/meta-boxes.php) and related content — the densest
 *          concentration of template tags in the theme, and so the likeliest
 *          place for a notice.
 */
test('single post renders with no PHP notice and no raw shortcode text @fresh @activation', async ({
  page,
  content,
}) => {
  const post = await content.aPost();
  await assertCleanRender(page, post.link, 'single post');
});

/**
 * @area    activation
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     page.php + content-page.php render without single.php's post-meta
 *          chrome, so a notice guarded by an `is_page()`/`is_single()` branch
 *          in inc/functions.php's layout logic shows up here and nowhere
 *          else. WooCommerce's own cart/checkout/my-account pages are
 *          skipped by the fixture — they render app UI, not this template.
 */
test('page renders with no PHP notice and no raw shortcode text @fresh @activation', async ({ page, content }) => {
  const target = await content.aPage();
  await assertCleanRender(page, target.link, 'page (plain, non-builder)');
});

/**
 * @area    activation
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     search.php has its own no-results branch and its own title
 *          handling. The term is derived from a real post title so the
 *          populated branch is what gets exercised, not the empty one.
 */
test('search results render with no PHP notice and no raw shortcode text @fresh @activation', async ({
  page,
  content,
}) => {
  const term = await content.aSearchTerm();
  await assertCleanRender(page, `/?s=${encodeURIComponent(term)}`, `search results (${term})`);
});

/**
 * @area    activation
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     404.php is the template nobody opens by hand, so a regression in
 *          it survives longest. The status assertion is load-bearing for the
 *          whole file: it is what proves the other five cases are hitting
 *          real content rather than quietly 404ing.
 */
test('404 renders with no PHP notice and no raw shortcode text @fresh @activation', async ({ page }) => {
  const response = await assertCleanRender(page, '/this-page-does-not-exist-9a8b7c/', '404');
  expect(response?.status(), '404 template should actually respond 404').toBe(404);
});

/**
 * The shared assertion. Every case above differs only in which URL it resolves
 * and what it calls it in a failure message.
 */
async function assertCleanRender(page: import('@playwright/test').Page, path: string, name: string) {
  const response = await page.goto(path);

  // Everything except the 404 case must be a real, rendered page. Without
  // this, a path that stopped resolving degrades into a vacuous pass.
  if (name !== '404') {
    expect(response?.status(), `${name} (${path}) should render, not error`).toBeLessThan(400);
  }

  const bodyText = await page.locator('body').innerText();

  // PHP surfaces problems as literal text in the response when
  // WP_DEBUG_DISPLAY is on — these strings should never reach the DOM.
  for (const marker of ['Notice:', 'Warning:', 'Deprecated:', 'Fatal error:']) {
    expect(bodyText, `Found PHP "${marker}" text on ${name} (${path})`).not.toContain(marker);
  }

  // A shortcode that did not resolve prints as literal `[tag ...]` text.
  expect(bodyText, `Found raw shortcode-looking text on ${name} (${path})`).not.toMatch(
    /\[\/?[a-z][a-z0-9_-]*(\s[^\]]*)?\]/i,
  );

  await expect(page.locator('body')).toBeVisible();
  return response;
}
