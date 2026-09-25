import { test, expect } from '../../fixtures/customizer';
import type { FrameLocator, Locator, Page } from '@playwright/test';

const MODS: Record<string, unknown> = {
  spacious_content_font_typography: { 'font-family': 'Merriweather', 'font-weight': 'regular' },
  spacious_titles_font_typography: { 'font-family': 'Pacifico', 'font-weight': 'regular' },
  spacious_primary_color: '#d63384',
};

type Look = { family: string; size: string; color: string };

async function look(element: Locator): Promise<Look> {
  return element.evaluate((el) => {
    const cs = getComputedStyle(el);
    return {
      family: cs.fontFamily.split(',')[0].replace(/["']/g, '').trim(),
      size: cs.fontSize,
      color: cs.color,
    };
  });
}

async function latestPost(page: Page): Promise<{ id: number; link: string }> {
  const response = await page.request.get('/wp-json/wp/v2/posts?per_page=1&status=publish&orderby=date&order=desc');
  expect(response.ok(), 'could not list published posts over REST').toBeTruthy();
  const posts = (await response.json()) as Array<{ id: number; link: string }>;
  expect(posts.length, 'this spec needs one published post with a paragraph').toBeGreaterThan(0);
  return posts[0];
}

async function editorCanvas(page: Page, postId: number): Promise<FrameLocator> {
  await page.goto(`/wp-admin/post.php?post=${postId}&action=edit`);
  const canvas = page.frameLocator('iframe[name="editor-canvas"]');
  await canvas.locator('.editor-post-title__input').waitFor({ timeout: 30_000 });
  return canvas;
}

/**
 * @area    customizer
 * @tier    fresh
 * @source  agent 2026-09-25
 * @why     themegrill/spacious-pro#66 (free part): the block editor loaded only a
 *          static stylesheet and not even the bundled Lato, so it ignored the
 *          Customizer body font, titles font and primary color. The fix builds
 *          editor CSS from the same settings as the front end, so this guard
 *          compares the editor with the front end for the same post instead of
 *          hardcoding pixels.
 *
 * Covers the paragraph (body font, size, color), a link (primary color), the post
 * title (titles font, front-end title size) and that the chosen fonts actually
 * loaded inside the editor iframe rather than only being declared.
 */
test('block editor shows the same Customizer typography and colors as the front end @fresh @customizer', async ({
  page,
  customizer,
}) => {
  test.setTimeout(150_000);

  const post = await latestPost(page);

  await customizer.open();
  const original = await page.evaluate(
    (ids) => Object.fromEntries(ids.map((id) => [id, (window as any).wp.customize(id).get()])),
    Object.keys(MODS),
  );

  try {
    for (const [id, value] of Object.entries(MODS)) {
      await customizer.setControl(id, value);
    }
    await customizer.publish();

    await page.goto(`${post.link}${post.link.includes('?') ? '&' : '?'}e2e-cache-bust=${Date.now()}`);
    const front = {
      paragraph: await look(page.locator('.entry-content p').first()),
      title: await look(page.locator('.header-post-title-class').first()),
    };

    expect(front.paragraph.family, 'front end did not apply the published body font').toBe('Merriweather');
    expect(front.title.family, 'front end did not apply the published titles font').toBe('Pacifico');

    const canvas = await editorCanvas(page, post.id);
    const paragraph = canvas.locator('.is-root-container p').first();

    await expect
      .poll(async () => (await look(paragraph)).family, { timeout: 20_000 })
      .toBe('Merriweather');

    expect(await look(paragraph), 'editor paragraph differs from the front end').toEqual(front.paragraph);
    expect(
      await look(canvas.locator('.editor-post-title__input')),
      'editor post title differs from the front end',
    ).toEqual(front.title);

    const linkColor = await canvas.locator('body').evaluate((body) => {
      const probe = body.ownerDocument.createElement('a');
      probe.href = '#e2e';
      body.querySelector('.is-root-container')?.appendChild(probe);
      const color = getComputedStyle(probe).color;
      probe.remove();
      return color;
    });
    expect(linkColor, 'editor links do not use the primary color').toBe('rgb(214, 51, 132)');

    const loaded = await canvas.locator('body').evaluate(async () => {
      await document.fonts.ready;
      return ['Merriweather', 'Pacifico'].map((family) =>
        [...document.fonts].some((face) => face.family.replace(/["']/g, '') === family && face.status === 'loaded'),
      );
    });
    expect(loaded, 'Customizer fonts are declared but not loaded inside the editor iframe').toEqual([true, true]);
  } finally {
    // Courtesy revert for a reused context; the customizer fixture's teardown is the real safety net.
    try {
      await customizer.open();
      for (const [id, value] of Object.entries(original)) {
        await customizer.setControl(id, value);
      }
      await customizer.publish();
    } catch (revertError) {
      console.warn('Revert of the block editor typography controls did not complete cleanly:', revertError);
    }
  }
});
