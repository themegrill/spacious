# Spacious

<!-- This is a source+docs+git-history draft. No live browser QA session was
performed to produce this file — nothing below has been clicked, seen render,
or verified against a running site. Every claim is either a file:line/commit
citation or an explicit TODO for a human. -->

- **Slug:** `spacious` · **Type:** theme (free) · **Textdomain:** `spacious`
- **Repo:** `git@github.com:themegrill/spacious.git` (confirmed via `git remote -v`)
- **Pro companion:** Spacious Pro, sibling theme directory `spacious-pro` on
  this machine (`has_pro: true` per detect-product.mjs) — a **standalone**
  theme, not a child theme (docs: "Upgrading from Spacious to Spacious Pro",
  `.themegrill-qa/docs/getting-started.md`) — TODO confirm against Pro source
- **Jira/ticket key:** three `TT-####` refs seen in commit subjects
  (`TT-3332`, `TT-3278`, `TT-3231`, e.g. commit `1309e23`) — TODO confirm `TT`
  is the project key and not coincidental
- **Supported:** `Requires PHP: 7.4` (style.css:10). `Tested up to: 6.8`
  (style.css:9). **No `Requires at least` (minimum WP version) header found**
  in style.css or readme.txt — grepped both files, zero matches. readme.txt
  has no standard plugin-style version header block at all (readme.txt:1-40).
- **Version:** 1.9.12 (style.css:8, confirmed by detect-product.mjs)

## What it is, in two sentences

A free multipurpose/business WordPress theme (style.css:7) built around a
custom, config-array-driven Customizer framework
(`inc/customizer/core/class-spacious-customizer-framework.php`) rather than
scattered raw `$wp_customize->add_*` calls — panels/sections/controls are
declared as arrays in `inc/customizer/options/**/*.php` and consumed by the
framework's `register_options()`/`register_setting_control()` methods
(class-spacious-customizer-framework.php:632, :762). Content is composed via
five theme-specific "TG:" business widgets plus WordPress core widget areas
(no theme-registered post types, taxonomies, shortcodes, or REST routes were
found in source), and starter-site content is provided by the separate
ThemeGrill Demo Importer plugin.

## How the options are implemented

- **Settings framework:** a custom, config-array-driven Customizer framework
  (`inc/customizer/core/class-spacious-customizer-framework.php:632,762`), not
  raw `$wp_customize->add_*` calls and not a React app. Panels/sections/controls
  are declared as plain PHP arrays in `inc/customizer/options/**/*.php`.
- **Two code paths?** None found. Unlike ColorMag's builder-vs-legacy toggle,
  no grep for a "switch between two settings surfaces" pattern
  (`inc/customizer/core/**`, `inc/functions.php`) turned one up — TODO: a
  human should confirm this negative, since it is exactly the kind of fact a
  source-only pass is most likely to miss if it's implemented unusually.
- **Anything Pro-gated in the UI:** N/A for this file (this is the free
  theme). See Spacious Pro's own knowledge.md, "Pro-only feature surface", for
  what a free-build test will see as absent.

## Critical flows

TODO: confirm ordering — proposed from fix-commit density and doc-outcome
density, not from any live session or product-owner input.

1. **customizer** — Customizer round-trip (options → theme_mods → rendered
   output). The legacy monolithic `inc/customizer.php` (removed/split by the
   time of the current tree; no longer exists at that path — confirmed
   `ls` returns "No such file or directory") shows **32 fix-commit touches**
   in the last 400 commits, more than any other single file, before it was
   split into `inc/customizer/**`. Its successor files
   (`class-spacious-customizer-register-sections-panels.php`,
   `class-spacious-customizer-framework.php`, and the per-section files under
   `inc/customizer/options/`) are where that logic now lives.
2. **upgrade** — Migration of the old Options Framework (`get_option('spacious')`)
   into theme_mods, and a separate "1.9.0 major controls" migration
   (`inc/migration.php:20-73`, `:80-134`). Both run on `after_setup_theme`
   (`inc/migration.php:73`, `:134`) and gate themselves with one-shot option
   flags (`spacious_major_controls_migrate`, `spacious_customizer_transfer`).
   `inc/migration.php` shows 10 total touches / 3 fix-commit touches in the
   mined window.
3. **header** — Header area (Site Identity, Top Bar, Primary Menu, Header
   Button): richest doc section by outcome count (5 stated outcomes,
   `.themegrill-qa/docs/header.md`) and the section users most often ask
   "where did my customizer options go" about after a major update (FAQ:
   "Where are the customizer options available after the Spacious Major
   update?", `.themegrill-qa/docs/faqs.md`).
4. **demo-import** — ThemeGrill Demo Importer integration + the theme's own
   post-import reconciliation notice (`inc/demo-import-migration.php`,
   entire file). Docs explicitly warn this is a lossy/risky operation on an
   existing site (see "Known-fragile areas" and "Upgrade paths" below).
5. **responsive/mobile-menu** — readme.txt changelog shows the mobile
   menu/submenu-toggle area fixed repeatedly across unrelated versions (see
   Known-fragile below) rather than once.
6. **woocommerce** — compatibility layer exists
   (`inc/customizer/options/woocommerce/*`, `inc/functions.php`,
   `inc/header-functions.php`) but not exercised in this draft — no live
   WooCommerce site available.

## Admin surfaces

| Surface | Where | Notes |
|---|---|---|
| Customizer | `/wp-admin/customize.php` | Panels registered in `inc/customizer/class-spacious-customizer-register-sections-panels.php:34-317`: `spacious_customize_upsell_section` (Pro upsell, priority 1), `spacious_global_options`, `spacious_header_options`, `spacious_slider_options`, `spacious_content_options`, `spacious_footer_options`, plus a `spacious_social_links_options` section and two `woocommerce`-panel sections. ~74 control config entries found across `inc/customizer/options/**/*.php` (`grep -rc "'type'.*=>.*'control'\|'control_type'"`). |
| Theme options page | Appearance → `{Theme Name} Options` (`add_theme_page`, `inc/admin/class-spacious-dashboard.php:36`, capability `edit_theme_options`) | Resolves parent theme name if `is_child_theme()` (class-spacious-dashboard.php:27-31) |
| Welcome/admin notices | `inc/admin/class-spacious-welcome-notice.php`, `class-spacious-notice.php`, `class-spacious-upgrade-notice.php`, `class-spacious-theme-review-notice.php` | Each gated by its own nonce + `current_user_can()` check (see Roles table) |
| AJAX: demo import trigger | `wp_ajax_import_button` (`inc/admin/class-spacious-welcome-notice.php:10`) | Handler: `welcome_notice_import_handler` |
| Widgets | `/wp-admin/widgets.php` | Custom widgets registered in `inc/widgets/widgets.php` and per-class files: TG: Featured Single Page, TG: Recent Work, TG: Service, TG: Testimonial, TG: Call to Action (all under `inc/widgets/class-spacious-*-widget.php`) |

## Frontend surfaces

No theme-registered custom post types, taxonomies, shortcodes, or REST
routes were found (`register_post_type`, `register_taxonomy`,
`add_shortcode`, `register_rest_route` all zero matches, whole-tree grep).
No `registerBlockType` usage found either (zero matches for `*.js`/`*.jsx`/
`*.json`). Frontend surfaces are template files (`header.php`, `content.php`,
`content-single.php`, `content-page.php`, `no-results.php`, etc.) plus the
widget areas documented in `.themegrill-qa/docs/how-to.md` (Business Top/
Middle-Left/Middle-Right/Bottom Sidebar, Right Sidebar, Footer Sidebar
One–Four, Footer Sidebar Full-Width). A "Business Template" page template and
a "Contact Page" template are documented (`how-to.md`) — TODO confirm exact
template file names in source.

Elementor front-end integration: `inc/elementor/elementor.php` enqueues
`inc/elementor/assets/css/elementor.css` and registers two extra scripts
(waypoints, countTo) on Elementor's own `elementor/frontend/*` hooks
(elementor.php:50-59). No Brizy/Beaver Builder/SiteOrigin-specific PHP hooks
were found in source despite style.css:7 naming all three as supported —
**DOC/MARKETING-COPY DRIFT**: style.css claims compatibility with "Brizy,
Beaver Builder, SiteOrigin, etc." but only Elementor has theme-side
integration code; the others may simply work as generic page-builder
plugins with no theme-specific hook needed — TODO confirm, don't treat as a
bug without checking.

## Roles and capabilities

| Role | Should be able to | Must NOT be able to |
|---|---|---|
| Administrator | Reach Customizer, theme options page (`edit_theme_options`), dismiss admin notices (`manage_options` in `class-spacious-welcome-notice.php:36,85,106`) | — |
| Any user with `publish_posts` | Dismiss the upgrade notice (`inc/admin/class-spacious-notice.php:62,81`; `class-spacious-upgrade-notice.php:8`) — TODO: this is a broad cap for an admin-only-looking notice, worth confirming intent | — |
| Any user with `edit_posts` | Dismiss the theme-review notice (`inc/admin/class-spacious-theme-review-notice.php:74`) | — |
| Post/page editor | Edit own post/page meta (layout meta box) — `current_user_can('edit_post'|'edit_page', $post_id)` (`inc/admin/meta-boxes.php:102,105`), nonce-checked (`meta-boxes.php:92`) | — |
| Any logged-in user | See a "no results" publish-posts prompt only if `current_user_can('publish_posts')` (`no-results.php:16`) | — |
| Widget content author | Use raw/unfiltered HTML in CTA/Testimonial/Recent-Work widget fields only if `current_user_can('unfiltered_html')` (`class-spacious-recent-work-widget.php:60`, `class-spacious-testimonial-widget.php:49`, `class-spacious-call-to-action-widget.php:48,54`) | — |
| Subscriber / logged out | Read the frontend | Everything admin — TODO: not tested with a real Subscriber account this draft (no live site) |

No theme-specific custom capability was found; all checks use WordPress core
capabilities.

## Integrations

- **ThemeGrill Demo Importer** (separate plugin, not bundled) — required for
  starter-site import; theme detects it via
  `get_option('themegrill_demo_importer_activated_id')`
  (`inc/demo-import-migration.php:19`) and shows a post-import "Fix Imported
  Demo" migration notice (`demo-import-migration.php:18-53`). Docs explicitly
  warn against importing onto an existing site with content already on it
  (`.themegrill-qa/docs/faqs.md`: "Can We Import Demo in Our Existing
  Website?" — "not recommended... design... might not be the same after the
  demo is imported").
- **WooCommerce** — `inc/customizer/options/woocommerce/class-spacious-customize-woocommerce-design-options.php`,
  `...-sidebar-options.php`; theme mods `spacious_woo_archive_layout`,
  `spacious_woo_product_layout`, `spacious_cart_icon` (grep of
  `get_theme_mod(` keys). Not exercised this draft.
- **Elementor** — theme-side integration file `inc/elementor/elementor.php`
  (see Frontend surfaces above).
- **Contact Form 7** — documented as the recommended contact-form plugin for
  the "Contact Page" template (`.themegrill-qa/docs/how-to.md`, "How to
  create a Contact Us Page?") — no theme-side CF7 hook found in source, so
  this is a documentation recommendation, not an enforced dependency.
- **Companion Addons for Elementor** — required specifically for "Pro Plus"
  demo tiers per docs (`.themegrill-qa/docs/getting-started.md`, "Import
  Spacious Pro Plus Demos") — Pro-tier concern, not applicable to this free
  theme's own code.

## Data model / persistence

- **Theme mods** (`get_theme_mod`/`set_theme_mod`, stored in
  `theme_mods_spacious`): 53 distinct keys found (grep of
  `get_theme_mod\(\s*['"][a-zA-Z0-9_-]*` across `*.php`, deduplicated),
  including `spacious_primary_color`, `spacious_color_skin`,
  `spacious_site_layout`, `spacious_default_layout`,
  `spacious_header_display_type`, `spacious_header_button_setting`,
  `spacious_slider_*` (title/text/image/link/button_text),
  `spacious_footer_design`, `spacious_footer_editor`,
  `spacious_woo_archive_layout`, `spacious_woo_product_layout`, and others
  (full list captured during this draft's grep pass, not reproduced in full
  here to keep this file short — re-run
  `grep -rno "get_theme_mod(\s*['\"][a-zA-Z0-9_-]*" --include=*.php .` to see
  all 53).
- **Options** (`get_option`): 17 distinct keys found, notably the **legacy**
  `spacious` option (old Options-Framework array, pre-Customizer — see
  Upgrade paths), `spacious_major_controls_migrate`,
  `spacious_customizer_transfer`, `themegrill_demo_importer_activated_id`
  (read, not owned by this theme), `spacious_demo_import_migration_notice_dismiss`,
  `spacious_upgrade_notice_start_time`.
- **Post meta**: `spacious_page_layout` (per-post/page layout override) —
  read in `functions.php:31`, `inc/functions.php:139,144,268,273`; written
  via the meta box in `inc/admin/meta-boxes.php:69,111,114` (nonce-checked,
  `meta-boxes.php:92`).
- **No custom database tables** — zero matches for `CREATE TABLE`/`dbDelta`
  in theme code.

## Upgrade paths that matter

TODO — needs a human who knows the pre-1.9.0 Options-Framework shape.
`inc/migration.php` contains two distinct, independently-gated routines, both
hooked on `after_setup_theme`:

1. `spacious_major_controls_migrate()` (`inc/migration.php:20-73`, hook at
   line 73) — reshapes the **legacy `spacious` option array itself**: pulls
   `spacious_content_font` / `spacious_titles_font` out and re-writes them as
   nested `spacious_content_font_typography['font-family']` /
   `spacious_titles_font_typography['font-family']`, then deletes the two
   flat keys (`inc/migration.php:44-64`) and sets the
   `spacious_major_controls_migrate` flag so it runs once.
2. `spacious_options_migrate()` (`inc/migration.php:80-134`, hook at line
   134, priority 12 — runs after #1) — transfers the entire legacy
   `spacious` option array (or, for a child theme, the current stylesheet's
   own like-named option) into `theme_mods_spacious` /
   `theme_mods_<stylesheet>`, gated by `spacious_customizer_transfer`.

Both routines special-case a **demo-import migration** path
(`spacious_demo_import_migration()`, defined in
`inc/demo-import-migration.php:79-89`) that skips the "already migrated"
short-circuit so a freshly-imported demo's options get processed regardless
of the flags.

**What must survive each of these, and what a bad interaction between #1,
#2, and a demo import looks like, is not derivable from a quick read — needs
whoever wrote `inc/migration.php` or a changelog deep-dive.** Separately,
docs state a **cross-major-version claim** worth flagging to a human even
though it's a Free→Pro theme switch, not covered by the file above: "All
your content theme settings will remain as it is even after switching to the
Pro theme" (`.themegrill-qa/docs/getting-started.md`, "Upgrading from
Spacious to Spacious Pro") — Spacious Pro is a **separate stylesheet**
(`spacious-pro`), so WordPress's own per-stylesheet `theme_mods_<slug>`
storage would not carry settings across automatically unless Pro's own code
does a transfer; no such transfer code exists in this (free) theme's source,
so it would have to live in `spacious-pro` — **TODO confirm against Pro
source, do not assume the doc claim is implemented here.**

## Known-fragile areas

| Area | Evidence |
|---|---|
| Customizer core (`inc/customizer.php` pre-split, now `inc/customizer/**`) | 32 fix-commit touches in the last 400 commits (`git log --oneline -400 --diff-filter=M --name-only`, filtered to fix/bug/hotfix/regress/revert commits) — the single most fix-touched code area found |
| `style.css` | 58 fix-commit touches — mostly styling regressions per changelog entries (e.g. "Fix - Blockquote design issue", "Fix - Gallery padding for Gutenberg", commit `cc58490`) |
| `inc/functions.php` | 24 fix-commit touches |
| `assets/scss/_header.scss` | 24 fix-commit touches — consistent with repeated header/mobile-menu changelog fixes below |
| `assets/scss/_theme-style.scss` | 23 fix-commit touches |
| `js/navigation.js` | 11 fix-commit touches — mobile/menu navigation logic |
| Mobile menu / submenu toggle button | readme.txt changelog shows this fixed **more than once** across unrelated releases: "Fix - Missed close span tag for menu toggle button" (readme.txt:87), "Fix - Position of menu toggle button and input search field" (readme.txt:84), "Fix - Submenu location while fixing out of viewport" (readme.txt:237), "Fix - submenu out of viewport" (readme.txt:248), "Fix - Mobile menu item with sub menu not opening in one click" (readme.txt:243) — a "fixed X again" pattern per the task's own heuristic |
| Header display type / setting IDs | A whole run of near-identical "Fix - Id of `<section>` options" commits across one release (`d2fab58`, `6fb604e`, `7ee573e`, `243aca0`, `96c8563`, `44995ce`, `98dc78c`, `e5ea41d`, `a6884e6`, `90a924c`, `dde8b61`, `95b17aa`, `e97dd35`, `b19c3f7`, `5132cb7`, `673ffbe` — 16 commits in one burst) plus later "Fix - Wrong setting id set for Header Display Type option" (readme.txt:210) and "Fix - Empty ID for header display type" (readme.txt:167) — setting-ID mismatches recur specifically around the header/customizer-options refactor |
| Layout at ~978px (box/wide breakpoint) | readme.txt shows this specific breakpoint fixed on three separate occasions: "Fixed layout issue for wide 978px and narrow 978px layout..." (readme.txt:460), "Fixed the layout issue for no-sidebar-full-width layout" (readme.txt:470), "Fix - Box and Wide at 978px Layout issue on Tab is fixed" (readme.txt:305) |
| `style-rtl.css` | 13 fix-commit touches — smaller than ColorMag's equivalent number but still recurring, and RTL has no test coverage in this draft (no live QA session was run at all) |
| Demo-import security | `63d5b4a fix import_demo notice security issue (#100)` — a security-classed fix in the demo-import notice path; worth a closer look given this same subsystem (`inc/demo-import-migration.php`) still trusts `$_GET` nonces without additional capability checks beyond the implicit "can see wp-admin" — TODO confirm intended capability gate |

## Known non-issues

<!-- Every false positive the agent reports gets a line here, with a reason. -->
TODO: fill in as false positives are found. Empty because no live QA session
has been run against this theme yet.

## Environment notes

TODO — no live site was used for this draft. A human should record: the
reference test site's WP/PHP versions, active plugins (WooCommerce? Demo
Importer? Elementor?), whether a demo is imported, and any local dev quirks
(sockets, wp-cli availability, credentials location) the way the sibling
ColorMag knowledge file does.
