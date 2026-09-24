import { test, expect } from '../../fixtures/wp-admin';
import { baseUrl } from '../../env';

const THEME_OPTIONS_PATH = '/wp-admin/themes.php?page=spacious-options';
const CUSTOMIZER_PATH = '/wp-admin/customize.php';

/**
 * @area    roles
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     A Subscriber reaching the Customizer or the theme options page is
 *          a privilege-escalation bug, not a UX one — it would let any
 *          registered user rewrite the site's appearance.
 *          .themegrill-qa/knowledge.md's "Roles and capabilities" table
 *          declares both surfaces as admin-only: the Customizer (core
 *          WordPress `customize` capability, mapped from `edit_theme_options`
 *          by default) and the theme options page, which
 *          `inc/admin/class-spacious-dashboard.php:36` registers via
 *          `add_theme_page(..., 'edit_theme_options', 'spacious-options', ...)`
 *          — an explicit capability argument, not a default. No
 *          theme-specific custom capability exists anywhere in this theme
 *          (knowledge file, "Roles and capabilities": "all checks use
 *          WordPress core capabilities"), so this is really asserting that
 *          `edit_theme_options` — a capability neither Subscriber nor any
 *          other default non-admin role has — is genuinely enforced by both
 *          surfaces.
 *
 * Creates and tears down its own Subscriber through the REST API, so it needs
 * no pre-existing test user and leaves none behind — which is what makes this
 * `@fresh` on a disposable site. The nonce is read from `wpApiSettings`, which
 * the block editor always localizes, rather than assuming any particular
 * admin screen exposes it.
 *
 * NOT verified live — no Subscriber account has been exercised against a real
 * Spacious site yet. Written from the capability arguments in source
 * (`edit_theme_options` on both add_theme_page() and core's customize.php
 * gate), not from an observed 403.
 */
test('subscriber cannot reach the customizer or the theme options page @fresh @roles', async ({ page, request }) => {
  test.setTimeout(60_000);
  await page.goto('/wp-admin/post-new.php?post_type=post');
  const nonce = await page.evaluate(() => (window as any).wpApiSettings?.nonce);
  expect(nonce, 'Could not read a REST nonce from wpApiSettings — is the block editor still enqueuing it?').toBeTruthy();

  const username = `qa-subscriber-${Date.now()}`;
  const password = `Qa!${Math.random().toString(36).slice(2)}Aa1`;

  const createRes = await request.post('/wp-json/wp/v2/users', {
    headers: { 'X-WP-Nonce': nonce },
    data: {
      username,
      email: `${username}@example.test`,
      password,
      roles: ['subscriber'],
    },
  });
  expect(createRes.ok(), `Failed to create test subscriber: ${await createRes.text()}`).toBeTruthy();
  const created = await createRes.json();

  try {
    // Log in as the subscriber in a fresh, unauthenticated context so the
    // admin storageState session isn't disturbed for the rest of the run.
    // baseURL must be passed explicitly: a context created straight off the
    // browser does NOT inherit the config's `use.baseURL`.
    const subscriberContext = await page.context().browser()!.newContext({ baseURL: baseUrl() });
    const subscriberPage = await subscriberContext.newPage();
    try {
      await subscriberPage.goto('/wp-login.php');
      await subscriberPage.locator('#user_login').fill(username);
      await subscriberPage.locator('#user_pass').fill(password);
      await subscriberPage.locator('#wp-submit').click();
      await subscriberPage.waitForURL((u) => !u.pathname.endsWith('/wp-login.php'), { timeout: 30_000 });

      // Confirm the session from the auth cookie WordPress sets, rather than
      // by waiting for #wpadminbar. If WooCommerce (or any plugin) hides the
      // admin bar from non-admin roles and redirects them elsewhere, waiting
      // on #wpadminbar would time out on a login that had in fact succeeded —
      // a false failure that says nothing about the capability under test.
      const cookies = await subscriberContext.cookies();
      expect(
        cookies.some((c) => c.name.startsWith('wordpress_logged_in_')),
        `Subscriber "${username}" did not end up logged in — no wordpress_logged_in_ cookie was set.`,
      ).toBeTruthy();

      const customizeResponse = await subscriberPage.goto(CUSTOMIZER_PATH);
      expect(customizeResponse?.status(), 'Subscriber should be denied the Customizer').toBe(403);

      const optionsResponse = await subscriberPage.goto(THEME_OPTIONS_PATH);
      expect(optionsResponse?.status(), 'Subscriber should be denied the theme options page').toBe(403);
    } finally {
      await subscriberContext.close();
    }
  } finally {
    await request.delete(`/wp-json/wp/v2/users/${created.id}`, {
      headers: { 'X-WP-Nonce': nonce },
      data: { reassign: 1, force: true },
    });
  }
});

/**
 * @area    roles
 * @tier    fresh
 * @source  agent 2026-09-24
 * @why     The subscriber-denial spec above is only half the invariant — it
 *          proves nothing if the Customizer or the theme options page also
 *          happened to be broken for an Administrator (a misconfigured
 *          capability check can fail closed for everyone, not just
 *          non-admins, and that failure mode would not be caught above). Uses
 *          the suite's own cached admin session (`storageState`, set up once
 *          by auth.setup.ts) rather than creating a second throwaway user.
 *
 * NOT verified live — written from the same source citations as the spec
 * above, not from an observed 200.
 */
test('administrator can reach the customizer and the theme options page @fresh @roles', async ({ page }) => {
  const customizeResponse = await page.goto(CUSTOMIZER_PATH);
  expect(customizeResponse?.status(), 'Administrator should be able to open the Customizer').toBeLessThan(400);

  const optionsResponse = await page.goto(THEME_OPTIONS_PATH);
  expect(optionsResponse?.status(), 'Administrator should be able to open the theme options page').toBeLessThan(400);
});
