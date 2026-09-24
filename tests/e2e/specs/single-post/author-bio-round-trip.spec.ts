import { test, expect } from '../../fixtures/customizer';
import type { Page } from '@playwright/test';

const CONTROL_ID = 'spacious_author_bio';

/*
 * A REST nonce, read from a throwaway tab. Duplicated from fixtures/content.ts
 * rather than imported — see archive-display-type-full-content-vs-excerpt.spec.ts
 * in specs/blog-layout/ for why (this spec needs the `customizer` fixture's
 * base test, not `content`'s). Deliberately a plain block comment, not a
 * JSDoc one, for the same spec-parser reason documented there.
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

const TEST_BIO = 'E2E seeded author biography — exists so the author box has something to show.';

/**
 * @area    content
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     The knowledge file's Frontend surfaces section flags single-post
 *          template tags (author box, related posts) as unconfirmed. Read
 *          single.php in full to confirm this one: the author box is a real,
 *          independently-gated template feature (checkbox control AND a
 *          non-empty author biography), not a doc/marketing claim — worth
 *          guarding once confirmed.
 *
 * `spacious_author_bio` is a `checkbox` control, default `0`
 * (inc/customizer/options/content/class-spacious-customize-single-post-options.php:51-63,
 * with `partial.selector => '.author-box'` at line 58-60). `single.php:27-37`
 * gates the actual markup on BOTH conditions, not just the control:
 *
 *   if ( get_theme_mod( 'spacious_author_bio', 0 ) == 1 ) :
 *     if ( get_the_author_meta( 'description' ) ) :
 *       <div class="author-box clearfix"> ... </div>
 *     endif;
 *   endif;
 *
 * So a site with the control on but an empty author biography renders no
 * `.author-box` at all — this spec sets both: the control, and the
 * currently-logged-in (admin) user's `description` user meta, via REST
 * `/wp-json/wp/v2/users/<id>` (`description` is a core, always-writable
 * field on that endpoint for a user editing themself). Restores the
 * original description in `finally` regardless of how the test exits.
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet. Written from single.php and the options file above, both read
 * in full, not from an observed toggle.
 */
test('Content > Single Post > Author Bio shows/hides .author-box based on the control and the author bio @fresh @content', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);

  const nonce = await restNonce(page);

  const meRes = await page.request.get('/wp-json/wp/v2/users/me?context=edit', {
    headers: { 'X-WP-Nonce': nonce },
  });
  expect(meRes.ok(), `Failed to read current user: ${await meRes.text()}`).toBeTruthy();
  const me = await meRes.json();
  const userId: number = me.id;
  const originalDescription: string = me.description ?? '';

  const stamp = Date.now();
  const createRes = await page.request.post('/wp-json/wp/v2/posts', {
    headers: { 'X-WP-Nonce': nonce },
    data: {
      title: `E2E author bio ${stamp}`,
      slug: `spacious-e2e-author-bio-${stamp}`,
      status: 'publish',
      content: '<!-- wp:paragraph --><p>Body copy for the author-box check.</p><!-- /wp:paragraph -->',
      author: userId,
    },
  });
  expect(createRes.ok(), `Failed to seed post: ${await createRes.text()}`).toBeTruthy();
  const post = await createRes.json();

  await customizer.open({ control: CONTROL_ID });
  const originalControlValue = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);

  try {
    const updateRes = await page.request.post(`/wp-json/wp/v2/users/${userId}`, {
      headers: { 'X-WP-Nonce': nonce },
      data: { description: TEST_BIO },
    });
    expect(updateRes.ok(), `Failed to set author description: ${await updateRes.text()}`).toBeTruthy();

    // ---- control ON + bio set: .author-box renders ----
    await customizer.setControl(CONTROL_ID, true);
    await customizer.publish();
    await page.goto(post.link + '?e2e-cache-bust=' + Date.now());
    const authorBox = page.locator('.author-box');
    await expect(authorBox, '.author-box should render once spacious_author_bio is on and the author has a bio').toBeVisible();
    await expect(authorBox.locator('.author-description')).toContainText(TEST_BIO);

    // ---- control OFF: .author-box gone even though the bio is still set ----
    await customizer.setControl(CONTROL_ID, false);
    await customizer.publish();
    await page.goto(post.link + '?e2e-cache-bust=' + Date.now());
    await expect(
      page.locator('.author-box'),
      '.author-box should not render once spacious_author_bio is off, regardless of the author bio',
    ).toHaveCount(0);
  } finally {
    try {
      await customizer.setControl(CONTROL_ID, originalControlValue);
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
    try {
      await page.request.post(`/wp-json/wp/v2/users/${userId}`, {
        headers: { 'X-WP-Nonce': nonce },
        data: { description: originalDescription },
      });
    } catch (err) {
      console.warn(`Could not restore author description for user ${userId}:`, err);
    }
    try {
      await page.request.delete(`/wp-json/wp/v2/posts/${post.id}?force=true`, {
        headers: { 'X-WP-Nonce': nonce },
      });
    } catch (err) {
      console.warn(`Could not delete seeded post ${post.id}:`, err);
    }
  }
});
