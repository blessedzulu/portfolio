---
permalink: /llms.txt
---
@php
// llms.txt (https://llmstxt.org) - a plain-text map of the site for LLMs, built
// from the same config as the rest of the site.
$base    = rtrim($page->baseUrl, '/');
$site    = $page->site;
$person  = $page->person;
$abs     = fn ($path) => ($base ?: '') . $path;

echo "# {$site['name']}\n\n";
echo "> {$person['jobTitle']} in {$person['locality']}, {$person['country']}, building ambitious websites, apps and systems end to end - mostly with Laravel and PHP.\n\n";
echo "{$site['name']} designs and builds products he owns and runs, systems for universities and businesses, and open-source packages for the tools he uses every day.\n\n";

echo "## Projects\n";
foreach ($page->projects as $p) {
    $link = $p['url'] ?? $abs('/work');
    echo "- [{$p['name']}]({$link}): {$p['tagline']}\n";
}
echo "\n";

echo "## Pages\n";
echo "- [Work]({$abs('/work')}): Selected projects, client systems and open-source work.\n";
echo "- [About]({$abs('/about')}): Who {$site['name']} is and how he works.\n";
echo "- [Contact]({$abs('/contact')}): How to get in touch.\n\n";

echo "## Contact\n";
echo "- Email: {$person['email']}\n";
foreach ($page->socials as $s) {
    echo "- {$s['label']}: {$s['url']}\n";
}
@endphp
