{{--
    <head> SEO - meta, Open Graph, Twitter cards and JSON-LD structured data.
    Reads everything from config (site / person / socials), so it needs no
    per-template wiring.

    NOTE: the JSON-LD is assembled as PHP arrays and echoed via json_encode.
    illuminate/view registers a Blade directive named after the JSON-LD
    context key; the key below is concatenated ('@' . 'context') so that
    directive cannot rewrite the literal token.
--}}
@php
    $site   = $page->site;
    $person = $page->person;
    $base   = $page->baseUrl;                 // '' in dev, 'https://…' in production
    $url    = $page->getUrl();                // absolute once baseUrl is set
    $path   = trim($page->getPath(), '/');
    $isHome = $path === '';

    $siteName = $site['name'];
    $title    = $page->title ? $page->title . ' · ' . $siteName : $siteName;
    $desc     = $page->description ?? $site['description'];
    $ogImage  = $base . '/og.png';
    $isPost   = ! empty($page->date);

    // config values arrive as Jigsaw IterableObjects; foreach flattens them to
    // plain arrays for array functions and json_encode.
    $sameAs = [];
    foreach ($page->socials as $s) { $sameAs[] = $s['url']; }

    $knowsAbout = [];
    foreach ($person['knowsAbout'] as $k) { $knowsAbout[] = $k; }

    $personId = $base . '/#person';
    $siteId   = $base . '/#website';

    // --- schema.org graph ---
    $person_schema = [
        '@type'      => 'Person',
        '@id'        => $personId,
        'name'       => $siteName,
        'url'        => $base ?: '/',
        'jobTitle'   => $person['jobTitle'],
        'email'      => 'mailto:' . $person['email'],
        'address'    => [
            '@type'           => 'PostalAddress',
            'addressLocality' => $person['locality'],
            'addressRegion'   => $person['region'],
            'addressCountry'  => $person['country'],
        ],
        'knowsAbout' => $knowsAbout,
        'sameAs'     => $sameAs,
    ];

    $graph = [$person_schema];

    // Exactly ONE WebSite entity, on the home page, clean name, no
    // domain-shaped alternateName (learned the hard way - it makes Google
    // fall back to the bare domain as the SERP site name).
    if ($isHome) {
        $graph[] = [
            '@type'       => 'WebSite',
            '@id'         => $siteId,
            'url'         => $base ?: '/',
            'name'        => $siteName,
            'description' => $site['description'],
            'inLanguage'  => 'en',
            'publisher'   => ['@id' => $personId],
        ];
    }

    $pageType = 'WebPage';
    if ($isHome)              $pageType = 'ProfilePage';
    elseif ($path === 'about')   $pageType = 'AboutPage';
    elseif ($path === 'contact') $pageType = 'ContactPage';

    $graph[] = array_filter([
        '@type'       => $pageType,
        '@id'         => $url . '#webpage',
        'url'         => $url,
        'name'        => $title,
        'description' => $desc,
        'isPartOf'    => $isHome ? ['@id' => $siteId] : null,
        'about'       => ['@id' => $personId],
        'inLanguage'  => 'en',
    ]);

    $jsonLd = json_encode(
        ['@' . 'context' => 'https://schema.org', '@graph' => $graph],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $desc }}">
<meta name="author" content="{{ $siteName }}">
<link rel="canonical" href="{{ $url }}">

{{-- Open Graph --}}
<meta property="og:type" content="{{ $isPost ? 'article' : 'website' }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $page->title ?: $siteName }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:locale" content="{{ $site['locale'] }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $siteName }} - {{ $site['tagline'] }}">
@if ($isPost)
    <meta property="article:published_time" content="{{ date('c', $page->date) }}">
    <meta property="article:author" content="{{ $siteName }}">
@endif

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $page->title ?: $siteName }}">
<meta name="twitter:description" content="{{ $desc }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:creator" content="{{ $page->twitterHandle }}">

{{-- structured data --}}
<script type="application/ld+json">{!! $jsonLd !!}</script>
