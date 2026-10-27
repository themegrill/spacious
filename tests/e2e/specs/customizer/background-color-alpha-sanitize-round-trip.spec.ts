import { test, expect } from '../../fixtures/customizer';

/**
 * The theme's alpha-color sanitizer still applies to `background_color` (issue #154).
 *
 * `Spacious_Customizer_FrameWork::register_panels_sections_controls()` swaps the
 * core sanitize callback of `background_color` for `sanitize_alpha_color`, which
 * turns the `rgba()` value the theme's alpha color picker sends into hex. It now
 * skips that swap when the setting is not registered yet, which used to be a
 * PHP 8 fatal error. This guards the normal Customizer path: core's own
 * `sanitize_hex_color_no_hash()` would reject an rgba value outright.
 */

const CONTROL_ID = 'background_color';

test('background color accepts an rgba value and renders it as hex @fresh @customizer', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);

  try {
    await customizer.setControl(CONTROL_ID, 'rgba(255,0,0,1)');
    await customizer.publish();

    await page.goto('/?e2e-cache-bust=' + Date.now());
    const css = await page.evaluate(() => document.getElementById('custom-background-css')?.textContent ?? '');
    expect(
      css.toLowerCase(),
      'An rgba background color was not saved as #ff0000, so the theme\'s sanitize_alpha_color ' +
        'override (class-spacious-customizer-framework.php) is no longer applied.',
    ).toContain('#ff0000');
  } finally {
    try {
      await customizer.open({ control: CONTROL_ID });
      await customizer.setControl(CONTROL_ID, original);
      await customizer.publish();
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
