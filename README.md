# blessedzulu.com

Personal site. Static, built with [Jigsaw](https://jigsaw.tighten.co) (Blade + flat-file markdown), Tailwind v4, and Vite. No database, no server to maintain.

## Develop

```bash
composer install
npm install
npm run dev        # vite, for hot-reloading CSS/JS while editing
```

## Build

```bash
npm run build      # runs vite build, which also builds the Jigsaw site
```

Output lands in `build_production/`. Preview it with any static server:

```bash
cd build_production && python3 -m http.server 8000
```

Deploy the contents of `build_production/` anywhere static (your Hetzner box, Cloudflare Pages, Netlify).

## Structure

```
source/
  _layouts/main.blade.php    shared layout: nav, footer, head
  _layouts/post.blade.php    layout for a blog post
  index.blade.php            home (the BZ fluid hero lives here)
  writing.blade.php          writing index
  _posts/*.md                blog posts, markdown + front matter
  _assets/css/main.css       Tailwind v4 + design tokens (@theme)
  _assets/js/main.js         reveal, year, fluid pause-gate (bundled by Vite)
  js/fluid.js                the BZ fluid (adapted from javierbyte/fluid-triangle, MIT)
  favicon.svg
config.php                   title, baseUrl, the `posts` collection
```

## The BZ fluid

`source/js/fluid.js` is a FLIP fluid simulation. The physics is Matthias Müller's (Ten Minute
Physics, MIT), by way of Javier Bórquez's ASCII version (`javierbyte/fluid-triangle`, MIT). The
only real change is the render characters, which spell **BZ** instead of his "FLUID", plus a calmer
palette and a gate that pauses it when it scrolls off-screen. The original licence stays in the file
header. It only runs on the home page.

Tuning lives in two places: colour and size in `main.css` (`.render` and `--cell-size`), and the
letters in `fluid.js` (`RENDER_CHARS`).

## Add a post

Create `source/_posts/my-slug.md`:

```markdown
---
extends: _layouts.post
section: content
title: My title
date: 2026-08-01
description: One line for the index and search.
---

Markdown body.
```

It appears automatically at `/writing/my-slug` and in the Writing lists. Newest first.

## Before launch

Placeholders to swap for the real thing (search the source):

- GitHub / X / LinkedIn URLs (currently point at the site roots) in `main.blade.php` and `index.blade.php`.
- The open-source "GitHub" link on the home Work list.
- An `og:image` for social sharing.

UK English throughout. No em dashes.
