# Spacious E2E suite

Playwright specs for Spacious, written so three different callers can run
them: you on your own machine, CI on every pull request, and the
`themegrill-qa` agent skills. They are the same specs in all three cases —
what changes is which **tier** runs, because not every spec is meaningful on
every kind of site.

This suite was scaffolded from the sibling ColorMag theme's own, more mature
e2e suite, adapted to Spacious's actual customizer framework, theme_mod keys
and templates (see `.themegrill-qa/knowledge.md` for what that adaptation was
based on). It started from zero: no spec has been run against a live site
yet, so treat every spec's docblock note about what is/isn't "verified live"
literally.

## The tier

Every test carries its tier as a tag in its **title**, because a title is what
Playwright's `--grep` actually matches. Only one tier exists so far:

**`@fresh`** — runs against a site with nothing on it but WordPress and
Spacious activated. Anything a `@fresh` spec needs, it seeds for itself
through `fixtures/content.ts`, which reuses what is already there and creates
only what is missing — so the same spec runs unchanged on a bare install or on
whatever `themegrill-qa`'s blueprint seeds. This is the tier CI runs.

There is no `@demo` tier yet: every spec written so far only needs a clean
WordPress + Spacious install, not a ThemeGrill demo import. Spacious's own
knowledge file explicitly warns that importing a demo onto an existing site is
lossy and not recommended, so this suite deliberately does not lean on one for
its `@fresh`-tier content. A future spec that specifically needs to guard the
demo-import migration routine (`inc/demo-import-migration.php`) would be the
first `@demo` spec — add the tag and a `test:e2e:demo` script together, not in
advance of having anything to run.

## The environment variables

Three values, each resolved through the same precedence chain in `env.ts`:
`TGQA_*` (exported by the platform's `run-suite.mjs`, so you never set these)
→ `SPACIOUS_*` (yours) → `WP_*` (legacy fallback) → a default.

| Value | Yours | Notes |
|---|---|---|
| Site URL | `SPACIOUS_BASE_URL` | Defaults to `https://themes.ddev.site` — this repo's DDEV project is named `themes` (`.ddev/config.yaml`), so that is what a local run actually resolves to, without any setup |
| Admin user | `SPACIOUS_ADMIN_USER` | **No default.** Missing credentials fail loudly rather than timing out on a login screen |
| Admin password | `SPACIOUS_ADMIN_PASS` | Same |

`TGQA_ENV` (`playground` \| `wp-env` \| `local`) tells specs what kind of site
they are on. It is what makes the DB-level helpers skip themselves on
Playground, which is PHP-WASM on SQLite with no MySQL, no real cron and no
outbound mail. Read it to branch; never weaken an assertion to make one spec
pass in both places — tag it `@demo` (or a future non-`local` tier), or skip
it with a stated reason.

## Where `.env.local` goes

**In the theme root, next to `package.json`** — not in this directory. Copy
`tests/e2e/.env.example` to `.env.local` and fill it in. It is gitignored and
must stay that way: a credential never belongs in a tracked file. A run
against a real (non-disposable) site also needs the `WP_DB_*` block, which two
helpers use to trash stale Customizer changesets before the run and to
snapshot and restore the active theme's mods around it. Both are skipped
automatically on Playground.

## Running it

Against this repo's DDEV site, nothing to configure beyond `.env.local`:

```
pnpm test:e2e          # everything
pnpm test:e2e:fresh    # the CI tier — what a PR gates on
pnpm test:e2e:ui       # interactive
pnpm test:e2e:report   # open the last HTML report
```

Against a disposable Playground site, let the platform boot one and point the
suite at it — this is exactly what CI does, so it is the way to reproduce a CI
failure locally:

```
node "$THEMEGRILL_QA_HOME/scripts/run-suite.mjs" --tier fresh --boot playground --install
```

Or point the suite at any site yourself:

```
SPACIOUS_BASE_URL=https://example.test TGQA_ENV=local pnpm test:e2e:fresh
```

## Two things that will bite you

The suite logs in once per run (`auth.setup.ts`, a setup project) and caches
the session in `.auth/`. That cache is validated before it is trusted, so a
stale one re-logs in rather than failing the run — you should never need to
delete it by hand.

Spacious's Customizer controls (`inc/customizer/core/custom-controls/**`) are
plain `WP_Customize_Control` PHP subclasses driven by core Customizer JS, not a
React-rendered system — there is no *known* equivalent of the
`wp.customize(id).set()`-doesn't-reliably-repaint-the-preview gap that
ColorMag's Customind-based suite documents. But that has not been confirmed
against a live Spacious site either. The customizer specs here only assert the
publish-then-reload and reopen-shows-persisted-value legs, not the live-preview
leg, until a live session confirms one way or the other — see
`fixtures/customizer.ts`'s docblock.
