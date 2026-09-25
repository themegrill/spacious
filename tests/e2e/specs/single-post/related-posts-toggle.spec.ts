import { test, expect } from '../../fixtures/customizer';
import type { Page } from '@playwright/test';

const CONTROL_ID = 'spacious_related_posts_activate';

/*
 * A REST nonce, read from a throwaway tab. Duplicated from fixtures/content.ts
 * rather than imported — see archive-display-type-full-content-vs-excerpt.spec.ts
 * in specs/blog-layout/ for why. Deliberately a plain block comment, not a
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

/**
 * @area    content
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     The other half of the knowledge file's unconfirmed single-post
 *          template-tag list (see author-bio-round-trip.spec.ts's @why for
 *          the first half). Read single.php and inc/functions.php in full to
 *          confirm related posts is a real, independently gated feature
 *          before asserting anything about it.
 *
 * `spacious_related_posts_activate` is a `checkbox` control, default `0`
 * (inc/customizer/options/content/class-spacious-customize-single-post-options.php:100-107).
 * `single.php:21-24` gates the include on it directly:
 *
 *   if ( get_theme_mod( 'spacious_related_posts_activate', 0 ) == 1 ) {
 *     get_template_part( 'inc/related-posts' );
 *   }
 *
 * `inc/related-posts.php` calls `spacious_related_posts_function()`
 * (inc/functions.php:29-63), which — with the default `spacious_related_posts`
 * choice of `categories` — queries up to 3 OTHER posts
 * (`post__not_in => [$post->ID]`) sharing the viewed post's categories. Only
 * if that query has results does `inc/related-posts.php:3` render the
 * heading:
 *
 *   <h4 class="related-posts-main-title">
 *     ... <?php esc_html_e( 'You May Also Like', 'spacious' ); ?>
 *   </h4>
 *
 * Seeds a dedicated category with two posts in it — the "viewed" post (the
 * one this spec navigates to) and one "other" post (the one the related-posts
 * query is expected to surface) — rather than reusing whatever categories the
 * site already has, because the whole assertion depends on there being at
 * least one OTHER post in the viewed post's category, which is not something
 * an already-populated category can be trusted to guarantee (the fixture's
 * own `aPopulatedCategory()` helper only guarantees `count > 0`, i.e. it could
 * be populated by the very post being viewed).
 *
 * NOT verified live — no live Customizer session has been run against this
 * theme yet. Written from single.php, inc/related-posts.php and
 * inc/functions.php's spacious_related_posts_function(), all read in full,
 * not from an observed toggle.
 */
test('Content > Single Post > Related Posts shows/hides "You May Also Like" based on the control @fresh @content', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);

  const nonce = await restNonce(page);
  const stamp = Date.now();
  const created: Array<{ endpoint: string; id: number }> = [];

  const post = async <T>(path: string, data: Record<string, unknown>): Promise<T> => {
    const res = await page.request.post(path, { headers: { 'X-WP-Nonce': nonce }, data });
    if (!res.ok()) throw new Error(`Seeding ${path} failed (${res.status()}): ${await res.text()}`);
    return (await res.json()) as T;
  };

  await customizer.open({ control: CONTROL_ID });
  const originalControlValue = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);

  try {
    const category = await post<{ id: number }>('/wp-json/wp/v2/categories', {
      name: 'E2E Related Posts',
      slug: `spacious-e2e-related-cat-${stamp}`,
    });
    created.push({ endpoint: '/wp-json/wp/v2/categories', id: category.id });

    const other = await post<{ id: number; link: string; title: { rendered: string } }>('/wp-json/wp/v2/posts', {
      title: `E2E Other Post ${stamp}`,
      slug: `spacious-e2e-related-other-${stamp}`,
      status: 'publish',
      categories: [category.id],
      content: '<!-- wp:paragraph --><p>The other post that should show up as related.</p><!-- /wp:paragraph -->',
    });
    created.push({ endpoint: '/wp-json/wp/v2/posts', id: other.id });

    const viewed = await post<{ id: number; link: string }>('/wp-json/wp/v2/posts', {
      title: `E2E Viewed Post ${stamp}`,
      slug: `spacious-e2e-related-viewed-${stamp}`,
      status: 'publish',
      categories: [category.id],
      content: '<!-- wp:paragraph --><p>The post being viewed, whose related posts we check.</p><!-- /wp:paragraph -->',
    });
    created.push({ endpoint: '/wp-json/wp/v2/posts', id: viewed.id });

    // ---- control ON: heading + the other post's title render ----
    await customizer.setControl(CONTROL_ID, true);
    await customizer.publish();
    await page.goto(viewed.link + '?e2e-cache-bust=' + Date.now());
    await expect(
      page.getByRole('heading', { name: 'You May Also Like' }),
      'Related Posts heading should render once spacious_related_posts_activate is on',
    ).toBeVisible();
    await expect(page.locator('.related-posts')).toContainText(other.title.rendered);

    // setControl() drives window.wp.customize() in the CURRENT page — the
    // goto() above navigated away from the Customizer entirely, so it must
    // be reopened before the next setControl() call has anything to act on.
    await customizer.open({ control: CONTROL_ID });

    // ---- control OFF: neither renders ----
    await customizer.setControl(CONTROL_ID, false);
    await customizer.publish();
    await page.goto(viewed.link + '?e2e-cache-bust=' + Date.now());
    await expect(
      page.getByRole('heading', { name: 'You May Also Like' }),
      'Related Posts heading should not render once spacious_related_posts_activate is off',
    ).toHaveCount(0);
  } finally {
    // Published, not just set: on Playground the fixture's own MySQL-based
    // restore (customizer.ts / theme-mods-snapshot.ts) is a no-op, so this
    // publish is what actually reverts the live, persisted value there.
    try {
      await customizer.open({ control: CONTROL_ID });
      await customizer.setControl(CONTROL_ID, originalControlValue);
      await customizer.publish();
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }

    // Children (posts) before parent (category), newest first.
    for (const kind of ['post', 'category']) {
      for (const row of created.filter((c) => c.endpoint.includes(kind === 'post' ? 'posts' : 'categories')).reverse()) {
        try {
          await page.request.delete(`${row.endpoint}/${row.id}?force=true`, {
            headers: { 'X-WP-Nonce': nonce },
          });
        } catch (err) {
          console.warn(`Could not delete ${row.endpoint}/${row.id}:`, err);
        }
      }
    }
  }
});
