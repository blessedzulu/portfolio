---
permalink: /sitemap.xml
---
@php
// Emitted entirely from PHP so the output is valid XML from byte 0 (no Blade
// whitespace, and no short-open-tag clash with `<?xml`). Writing is omitted
// for now - it is not linked from the site yet.
$base = rtrim($page->baseUrl, '/');
$lastmod = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($page->routes as $r) {
    $loc = $base . ($r['url'] === '/' ? '/' : $r['url']);
    echo "  <url>\n";
    echo "    <loc>{$loc}</loc>\n";
    echo "    <lastmod>{$lastmod}</lastmod>\n";
    echo "    <priority>{$r['priority']}</priority>\n";
    echo "  </url>\n";
}
echo '</urlset>' . "\n";
@endphp
