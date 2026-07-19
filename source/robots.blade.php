---
permalink: /robots.txt
---
@php
$base = rtrim($page->baseUrl, '/');
echo "User-agent: *\n";
// Content usage signals (https://content-signals.org): allow search indexing,
// AI training and AI inference/RAG.
echo "Content-Signal: ai-train=yes, search=yes, ai-input=yes\n";
echo "Allow: /\n\n";
echo "Sitemap: {$base}/sitemap.xml\n";
@endphp
