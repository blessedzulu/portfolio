<?php

/*
|--------------------------------------------------------------------------
| Site configuration - the one file you edit to make this site yours.
|--------------------------------------------------------------------------
|
| This is a Jigsaw config. Every value here is available in any Blade view
| as `$page->key` (e.g. `$page->site['name']`, `$page->projects`). Templates
| read from here and never hardcode identity or content, so forking the site
| is: edit this file, drop in your og image, deploy.
|
| Design tokens (colours, fonts) live in source/_assets/css/main.css.
|
*/

return [

  /*
  |----------------------------------------------------------------------
  | Build
  |----------------------------------------------------------------------
  | `baseUrl` is used for absolute canonical/OG/sitemap URLs. It is empty
  | in local dev and set to the real domain in config.production.php.
  */
  'production' => false,
  'baseUrl' => $_ENV['JIGSAW_BASE_URL'] ?? '',

  /*
  |----------------------------------------------------------------------
  | Site identity
  |----------------------------------------------------------------------
  */
  'site' => [
    'name' => 'Blessed Zulu',
    'tagline' => 'Software engineer in Zambia.',
    'description' => 'Blessed Zulu is a software engineer in Ndola, Zambia, building software people rely on - products he owns, client systems and open-source packages.',
    'locale' => 'en_GB',
  ],

  /*
  |----------------------------------------------------------------------
  | Person - powers the Person JSON-LD and the About page intent
  |----------------------------------------------------------------------
  */
  'person' => [
    'jobTitle' => 'Software Engineer',
    'locality' => 'Ndola',
    'region' => 'Copperbelt',
    'country' => 'Zambia',
    'timezone' => 'Africa/Lusaka',
    'email' => 'hello@blessedzulu.com',
    // Topics for the Person schema's knowsAbout. Broader than the visible
    // "stack" chips below - safe to include domains as well as tools.
    'knowsAbout' => [
      'Laravel', 'PHP', 'Livewire', 'Filament', 'Alpine.js', 'Tailwind CSS',
      'NativePHP', 'JavaScript', 'SQL', 'Redis', 'Pest', 'Vite',
      'REST APIs', 'Mobile app development', 'Version control', 'Python', 'Data science', 'Full-stack web development',
      'Search engine optimisation', 'Software engineering',
    ],
  ],

  /*
  |----------------------------------------------------------------------
  | Social links - drives the footer, the contact page and schema sameAs
  |----------------------------------------------------------------------
  | `handle` is shown on the contact page; `url` is used everywhere.
  */
  'socials' => [
    ['label' => 'GitHub', 'handle' => '@blessedzulu', 'url' => 'https://github.com/blessedzulu'],
    ['label' => 'LinkedIn', 'handle' => 'in/blessedzulu', 'url' => 'https://www.linkedin.com/in/blessedzulu'],
    ['label' => 'X', 'handle' => '@blessedzulu_', 'url' => 'https://x.com/blessedzulu_'],
  ],
  /*
  |----------------------------------------------------------------------
  | Analytics
  |----------------------------------------------------------------------
  | Rybbit site ID. Read from the environment (.env locally, host env vars on
  | deploy) rather than committed, so a fork of this repo does not report into
  | someone else's stats. Leave the var unset to disable analytics entirely.
  | Only emitted on production builds, so local work is never tracked.
  */
  'analytics' => [
    'rybbitSiteId' => $_ENV['RYBBIT_SITE_ID'] ?? (getenv('RYBBIT_SITE_ID') ?: ''),
  ],

  'twitterHandle' => '@blessedzulu_',                          // for Twitter card attribution

  /*
  |----------------------------------------------------------------------
  | Stack - the tools shown as chips on the About page
  |----------------------------------------------------------------------
  | The reach-for-first toolkit. Keep this to concrete tools; broader
  | topics live in person.knowsAbout above.
  */
  'stack' => [
    'PHP', 'Laravel', 'Livewire', 'Filament', 'Alpine.js', 'Tailwind CSS',
    'NativePHP', 'JavaScript', 'SQL', 'Redis', 'Pest', 'Vite', 'Git', 'Python', 'APIs', 'AstroJS',
  ],

  /*
  |----------------------------------------------------------------------
  | Header navigation - add/remove a line to change the nav pill
  |----------------------------------------------------------------------
  | The Writing page still builds and is reachable by URL; it is simply
  | not linked here yet. Add ['label' => 'Writing', 'url' => '/writing']
  | to surface it again.
  */
  'nav' => [
    ['label' => 'Work', 'url' => '/work'],
    ['label' => 'About', 'url' => '/about'],
    ['label' => 'Contact', 'url' => '/contact'],
  ],

  /*
  |----------------------------------------------------------------------
  | Routes - the canonical set of indexable pages (drives sitemap.xml)
  |----------------------------------------------------------------------
  | Kept separate from `nav`: the sitemap includes the home page (which is
  | not in the nav - it's the logo), and the nav is just the header menu.
  | Add a page here to include it in the sitemap. Writing is intentionally
  | left out for now.
  */
  'routes' => [
    ['url' => '/', 'priority' => '1.0'],
    ['url' => '/work', 'priority' => '0.8'],
    ['url' => '/about', 'priority' => '0.8'],
    ['url' => '/contact', 'priority' => '0.7'],
  ],

  /*
  |----------------------------------------------------------------------
  | Project groups - the sections on the /work page, in order
  |----------------------------------------------------------------------
  */
  'projectGroups' => [
    'Projects' => 'Products I own',
    'Client Work' => 'Systems built for businesses',
    'Open Source' => 'Projects I maintain',
  ],

  /*
  |----------------------------------------------------------------------
  | Projects - the single source of truth for BOTH the home shortlist
  | and the full /work index. Add an item here and it appears in both.
  |----------------------------------------------------------------------
  | Fields:
  |   name       Project name (the product), NOT the client.
  |   tagline    One short line - used on the home shortlist.
  |   blurb      Fuller description - used on the /work page.
  |   role       Your role. Rendered as a labelled spec column (not a chip).
  |   platforms  Where it runs. Spec column, not chips.
  |   client     Who it was built for (null for your own products). Spec column.
  |   year       Optional, e.g. '2025' or '2023-2025'. Spec column; hidden if blank.
  |   package    Optional package/identifier (e.g. composer name). Spec column.
  |   tech       Technologies - the ONLY things rendered as chips.
  |   status     'Live', 'In progress', or null.
  |   group      Must match a key in projectGroups above.
  |   url,label  Optional external link + its label (null = plain row).
  |   featured   true = show on the home shortlist.
  */
  'projects' => [
    [
      'name' => 'Zamcalc',
      'tagline' => '30+ financial tools and calculators for Zambia.',
      'blurb' => 'The digital toolkit for Zambian financial calculations - PAYE and taxes, ZESCO units, bonds and investments, loans and 25+ tools, on web, Android and iOS.',
      'role' => 'Founder & Engineer',
      'platforms' => ['Web', 'Android', 'iOS'],
      'client' => null,
      'tech' => ['Laravel', 'Livewire', 'NativePHP'],
      'status' => 'Live',
      'year' => '',
      'group' => 'Projects',
      'url' => 'https://zamcalc.com',
      'urlLabel' => 'zamcalc.com',
      'featured' => true,
    ],
    [
      'name' => 'ZUCT SMS',
      'tagline' => 'Student management system for Zambia University College of Technology.',
      'blurb' => 'Student management system for Zambia University College of Technology. Built for rapid scale, and to support the institution\'s ambitious goal of becoming Zambia\'s leading technology and business training provider.',
      'role' => 'Engineer',
      'platforms' => ['Web'],
      'client' => 'Zambia University College of Technology',
      'tech' => ['Laravel', 'Livewire', 'Filament'],
      'status' => 'Live',
      'year' => '',
      'group' => 'Client Work',
      'url' => 'https://sms.zut.ac.zm',
      'urlLabel' => 'sms.zut.ac.zm',
      'featured' => true,
    ],
    [
      'name' => 'CBU Atlas',
      'tagline' => 'Student Information System for the Copperbelt University.',
      'blurb' => 'Student information system for the Copperbelt University. Modernised and re-engineered from the ground up for performance, scale, maintainability and reliability for Zambia\' second largest learning institution.',
      'role' => 'Engineer',
      'platforms' => ['Web'],
      'client' => 'The Copperbelt University',
      'tech' => ['Laravel', 'Livewire', 'Filament'],
      'status' => 'In progress',
      'year' => '',
      'group' => 'Client Work',
      'url' => null,
      'urlLabel' => null,
      'featured' => true,
    ],
    [
      'name' => 'Fleet Management Platform',
      'tagline' => 'Operations and financial reporting platform for Macroworld Services.',
      'blurb' => 'Operations and financial reporting platform for Lusaka Yango Partner and vehicle management startup, Macroworld Services.',
      'role' => 'Engineer',
      'platforms' => ['Web'],
      'client' => 'Macroworld Services',
      'tech' => ['Laravel', 'Livewire', 'Filament'],
      'status' => 'Live',
      'year' => '',
      'group' => 'Client Work',
      'url' => 'https://fleet.macroworldservices.com',
      'urlLabel' => 'fleet.macroworldservices.com',
      'featured' => true,
    ],
    [
      'name' => 'ZUCT Website',
      'tagline' => 'Institutional website for Zambia University College of Technology.',
      'blurb' => 'The institutional website for Zambia University College of Technology, the college\'s public online presence and primary marketing resource.',
      'role' => 'Engineer',
      'platforms' => ['Web'],
      'client' => 'Zambia University College of Technology',
      'tech' => ['Laravel', 'Livewire'],
      'status' => 'Live',
      'year' => '',
      'group' => 'Client Work',
      'url' => 'https://zut.ac.zm',
      'urlLabel' => 'zut.ac.zm',
      'featured' => false,
    ],
    [
      'name' => 'Macroworld Website',
      'tagline' => 'Corporate website and online presence for Macroworld Services.',
      'blurb' => 'Corporate website and online presence for Macroworld Services.',
      'role' => 'Engineer',
      'platforms' => ['Web'],
      'client' => 'Macroworld Services',
      'tech' => ['AstroJS'],
      'status' => 'Live',
      'year' => '',
      'group' => 'Client Work',
      'url' => 'https://macroworldservices.com',
      'urlLabel' => 'macroworldservices.com',
      'featured' => false,
    ],
    [
      'name' => 'NativePHP AdMob',
      'tagline' => 'Google AdMob plugin for NativePHP Mobile.',
      'blurb' => 'Google AdMob plugin for NativePHP Mobile - banner, interstitial, rewarded and app-open ads, with UMP consent and iOS App Tracking Transparency.',
      'role' => 'Author & Maintainer',
      'platforms' => [],
      'client' => null,
      'package' => 'blessedzulu/nativephp-admob',
      'tech' => ['PHP', 'Laravel', 'NativePHP', 'Swift', 'Kotlin'],
      'status' => null,
      'year' => '',
      'group' => 'Open Source',
      'url' => 'https://github.com/blessedzulu/nativephp-admob',
      'urlLabel' => 'View on GitHub',
      'featured' => false,
    ],
    [
      'name' => 'NativePHP Haptics',
      'tagline' => 'Haptic feedback plugin for NativePHP Mobile.',
      'blurb' => 'Haptic feedback plugin for NativePHP Mobile - impact, notification and selection styles, plus custom vibration patterns.',
      'role' => 'Author & Maintainer',
      'platforms' => [],
      'client' => null,
      'package' => 'blessedzulu/nativephp-mobile-haptics',
      'tech' => ['PHP', 'Laravel', 'NativePHP', 'Swift', 'Kotlin'],
      'status' => null,
      'year' => '',
      'group' => 'Open Source',
      'url' => 'https://github.com/blessedzulu/nativephp-mobile-haptics',
      'urlLabel' => 'View on GitHub',
      'featured' => false,
    ],
    // [
    //   'name' => 'NativePHP Deep Links',
    //   'tagline' => 'Deep-link hardening for NativePHP Mobile.',
    //   'blurb' => 'Deep-link hardening for NativePHP Mobile - scopes Android App Links to specific path prefixes and preserves array query params through the WebView bridge.',
    //   'role' => 'Author & Maintainer',
    //   'platforms' => [],
    //   'client' => null,
    //   'package' => 'blessedzulu/nativephp-deeplinks',
    //   'tech' => ['PHP', 'NativePHP'],
    //   'status' => null,
    //   'group' => 'Open Source',
    //   'url' => 'https://github.com/blessedzulu/nativephp-deeplinks',
    //   'urlLabel' => 'View on GitHub',
    //   'featured' => false,
    // ],
  ],

  /*
  |----------------------------------------------------------------------
  | Collections
  |----------------------------------------------------------------------
  */
  'collections' => [
    'posts' => [
      'author' => 'Blessed Zulu',
      'sort' => '-date',
      'path' => 'writing/{filename}',
    ],
  ],
];
