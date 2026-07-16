<?php

use Valet\Drivers\ValetDriver;

/**
 * Serve the compiled Jigsaw site (build_local/) at portfolio.test.
 *
 * Jigsaw builds static HTML into build_local/ (dev) and build_production/ (prod),
 * so Herd/Valet needs its web root pointed at the build output rather than the
 * project root. Refresh build_local with `./vendor/bin/jigsaw build`, or run
 * `npm run dev` for hot reloading while editing.
 */
class LocalValetDriver extends ValetDriver
{
    private function webroot(string $sitePath): string
    {
        return $sitePath.'/build_local';
    }

    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        return is_dir($this->webroot($sitePath));
    }

    public function isStaticFile(string $sitePath, string $siteName, string $uri)
    {
        $root = $this->webroot($sitePath);

        // pretty URLs: /writing/ -> build_local/writing/index.html
        if (file_exists($path = $root.rtrim($uri, '/').'/index.html')) {
            return $path;
        }

        // real assets: /assets/..., /favicon.svg, /js/fluid.js
        if ($this->isActualFile($path = $root.$uri)) {
            return $path;
        }

        return false;
    }

    public function frontControllerPath(string $sitePath, string $siteName, string $uri): ?string
    {
        // static site: fall back to the built home page for anything unmatched
        $index = $this->webroot($sitePath).'/index.html';

        return $this->isActualFile($index) ? $index : null;
    }
}
