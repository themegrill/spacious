import { test, expect } from '../../fixtures/customizer';
import type { Page } from '@playwright/test';

const CONTROL_ID = 'spacious_archive_display_type';

/*
 * A REST nonce, read from a throwaway tab.
 *
 * Duplicated from fixtures/content.ts rather than imported, because that
 * module extends a DIFFERENT base test (`fixtures/wp-admin`'s `test`, with
 * its own `content` fixture) than this spec needs (`fixtures/customizer`'s
 * `test`, for the theme-mod publish + guaranteed post-test restore). Two
 * different `test.extend()` chains cannot both be imported into one spec
 * file without Playwright's `mergeTests`, and this suite's sibling ColorMag
 * hit the exact same shape and resolved it the same way — see
 * colormag/tests/e2e/specs/single-post/related-posts-recent-order.spec.ts's
 * identical docblock.
 *
 * Deliberately a plain block comment, not a JSDoc one: this suite's spec
 * parser attributes to a test the LAST docblock closing before it with only
 * whitespace in between — a `/** *\/` here would attach to the test below
 * instead of this spec's own @area/@tier block and silently drop it from
 * the index.
 */
async function restNonce(page: Page): Promise<string> {
  const scratch = await page.context().newPage();
  try {
    await scratch.goto('/wp-admin/post-new.php?post_type=post');
    const nonce = await scratch.evaluate(() => (window as any).wpApiSettings?.nonce);
    if (!nonce) {
      throw new Error('Could not read a REST nonce from wpApiSettings on post-new.php.');
    }
    return nonce as string;
  } finally {
    await scratch.close();
  }
}

// 60 distinct filler words plus a unique tail marker as the very last word.
// spacious_excerpt_length() (inc/functions.php:90-92) trims the excerpt to 40
// words, so the marker — word #61 — can only ever appear in the FULL content
// render, never in the excerpt one, regardless of how WP's word-splitting
// regex happens to count HTML/whitespace.
const FILLER = Array.from({ length: 60 }, (_, i) => `filler${i}`).join(' ');
const TAIL_MARKER = 'e2e-full-content-tail-marker-zzq';

/**
 * @area    content
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     `spacious_archive_display_type`'s effect is not only a body
 *          class (see the sibling body-class spec in this directory) — its
 *          `blog_full_content` choice swaps the actual template part the
 *          home-page loop renders. That is the choice a site owner most
 *          plausibly reaches for ("show my whole post on the blog page"),
 *          and it is driven by a genuinely different code path
 *          (`the_content()` vs `the_excerpt()`), so it is worth guarding
 *          independently of the class-only choices.
 *
 * `home.php:18` resolves `$format = spacious_posts_listing_display_type_select()`
 * per request (inc/functions.php:571-585) and loads
 * `get_template_part( 'content', $format )`. That function reads
 * `spacious_archive_display_type` (default `blog_large`) and maps it to
 * `content-blog-image-large.php` for `blog_large`/`blog_medium`/
 * `blog_medium_alternate` (all three call `the_excerpt()`,
 * content-blog-image-large.php:40) or to `content-blog-full-content.php`
 * for `blog_full_content` (which calls `the_content()` instead,
 * content-blog-full-content.php:21). `spacious_excerpt_length()`
 * (inc/functions.php:90-92) trims the excerpt to 40 words, and
 * `spacious_continue_reading()` (inc/functions.php:99-101) filters
 * `excerpt_more` to an empty string, so the excerpt renders as a plain
 * word-count truncation with no "…"/"Continue reading" marker at all —
 * this spec's own 61-word marker-tail content is what makes the truncation
 * observable regardless.
 *
 * Seeds one dedicated post (>40 words, unique tail marker) rather than
 * reusing whatever the site already has, because the whole assertion
 * depends on the seeded post's word count relative to the 40-word excerpt
 * cutoff — reused content of unknown length would make this spec's result
 * depend on what happened to already be on the site.
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet. Written from inc/functions.php, home.php and both
 * content-blog-*.php template parts read in full, not from an observed
 * toggle.
 */
test('Content > Blog Posts display type swaps excerpt for full content on the front page @fresh @content', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);

  const nonce = await restNonce(page);

  const stamp = Date.now();
  const createRes = await page.request.post('/wp-json/wp/v2/posts', {
    headers: { 'X-WP-Nonce': nonce },
    data: {
      title: `E2E full-content-vs-excerpt ${stamp}`,
      slug: `spacious-e2e-archive-display-${stamp}`,
      status: 'publish',
      content: `<!-- wp:paragraph --><p>${FILLER} ${TAIL_MARKER}</p><!-- /wp:paragraph -->`,
    },
  });
  expect(createRes.ok(), `Failed to seed post: ${await createRes.text()}`).toBeTruthy();
  const created = await createRes.json();

  await customizer.open({ control: CONTROL_ID });
  const originalValue = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);

  try {
    // ---- default (blog_large): excerpt, tail marker truncated away ----
    await customizer.setControl(CONTROL_ID, 'blog_large');
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const excerptText = await page.locator(`#post-${created.id}`).innerText();
    expect(
      excerptText,
      'Expected the 40-word excerpt to truncate before the tail marker with spacious_archive_display_type=blog_large',
    ).not.toContain(TAIL_MARKER);

    // setControl() drives window.wp.customize() in the CURRENT page — the
    // goto() above navigated away from the Customizer entirely, so it must
    // be reopened before the next setControl() call has anything to act on.
    await customizer.open({ control: CONTROL_ID });

    // ---- blog_full_content: the_content(), tail marker present ----
    await customizer.setControl(CONTROL_ID, 'blog_full_content');
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const fullText = await page.locator(`#post-${created.id}`).innerText();
    expect(
      fullText,
      'Expected the full post content (including the tail marker) with spacious_archive_display_type=blog_full_content',
    ).toContain(TAIL_MARKER);
  } finally {
    // Published, not just set: on Playground the fixture's own MySQL-based
    // restore (customizer.ts / theme-mods-snapshot.ts) is a no-op, so this
    // publish is what actually reverts the live, persisted value there.
    try {
      await customizer.open({ control: CONTROL_ID });
      await customizer.setControl(CONTROL_ID, originalValue);
      await customizer.publish();
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
    try {
      await page.request.delete(`/wp-json/wp/v2/posts/${created.id}?force=true`, {
        headers: { 'X-WP-Nonce': nonce },
      });
    } catch (err) {
      console.warn(`Could not delete seeded post ${created.id}:`, err);
    }
  }
});
