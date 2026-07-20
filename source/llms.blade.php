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
// Short positioning line only - the paragraph below already carries the range,
// so repeating it here would just duplicate inside the same file.
echo "> {$person['jobTitle']} in {$person['locality']}, {$person['country']}, building software people rely on.\n\n";
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
