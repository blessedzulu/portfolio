<!DOCTYPE html>
<html lang="en-GB">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Set the theme before first paint so there is no light-mode flash. --}}
  <script>
    (function() {
      try {
        var stored = localStorage.getItem('theme');
        var dark = stored ?
          stored === 'dark' :
          window.matchMedia('(prefers-color-scheme: dark)').matches;
        var root = document.documentElement;
        root.classList.toggle('dark', dark);
        root.style.colorScheme = dark ? 'dark' : 'light';
      } catch (e) {}
    })();
  </script>

  <link rel="canonical" href="{{ $page->getUrl() }}">
  <meta name="description" content="{{ $page->description ?? 'Blessed Zulu is a software engineer in Zambia.' }}">
  <title>{{ $page->title ? $page->title . ' · Blessed Zulu' : 'Blessed Zulu' }}</title>
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
  <meta name="theme-color" content="#ffffff">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@400;600;700&family=Instrument+Sans:ital,wght@0,400;0,500;1,400&family=Instrument+Serif:ital@0;1&display=swap"
    rel="stylesheet">
  @viteRefresh()
  <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
  <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
</head>

<body class="min-h-screen flex flex-col">

  <header class="sticky top-0 z-30">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 flex items-center justify-between h-20">
      <a href="/" class="font-serif text-xl tracking-tight shrink-0">Blessed Zulu</a>

      {{-- floating pill nav + separate circular theme toggle --}}
      <div class="flex items-center gap-2">
        <nav class="flex items-center gap-0.5 rounded-full border border-line bg-paper-2/70 p-1 backdrop-blur-md"
          aria-label="Primary">
          <a href="/work"
            class="rounded-full px-4 py-1.5 text-sm text-muted hover:text-ink transition-colors">Work</a>
          <a href="/writing"
            class="rounded-full px-4 py-1.5 text-sm text-muted hover:text-ink transition-colors">Writing</a>
          <a href="/about"
            class="rounded-full px-4 py-1.5 text-sm text-muted hover:text-ink transition-colors">About</a>
          <a href="/contact"
            class="rounded-full px-4 py-1.5 text-sm text-muted hover:text-ink transition-colors">Contact</a>
        </nav>
        <button id="theme-toggle" type="button" aria-label="Toggle dark mode"
          class="inline-flex h-10 w-10 shrink-0 cursor-pointer items-center justify-center rounded-full border border-line bg-paper-2/70 text-muted hover:text-ink transition-colors backdrop-blur-md">
          {{-- sun, shown in dark mode --}}
          <svg class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="4"></circle>
            <path
              d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4">
            </path>
          </svg>
          {{-- moon, shown in light mode --}}
          <svg class="block h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"></path>
          </svg>
        </button>
      </div>
    </div>
  </header>

  {{-- grows to fill short pages so the footer stays pinned to the bottom --}}
  <div class="flex-1">
    @yield('body')
  </div>

  {{-- footer doubles as the contact block. The whole footer is bg-paper
         (opaque) so the fixed fluid canvas can't show through the gap or side
         margins around the panel. --}}
  <footer id="contact" class="relative z-10 bg-paper pt-24 px-3 pb-3 sm:px-4 sm:pb-4">
    <div class="rounded-3xl bg-paper-2 px-6 py-12 sm:px-10 sm:py-14">
      <div class="mx-auto max-w-4xl">
        <div class="flex flex-wrap items-start justify-between gap-8">
          <div>
            <p class="flex items-center gap-2.5 text-sm text-muted">
              {{-- <span class="relative flex h-2 w-2" aria-hidden="true">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-ink/40"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-ink"></span>
                            </span> --}}
              Get in touch
            </p>
            <a href="mailto:hello@blessedzulu.com"
              class="mt-4 inline-block font-serif text-3xl u sm:text-4xl">hello@blessedzulu.com</a>
            <p class="mt-4 max-w-md text-muted">Available for work and collaborations.</p>
          </div>
          <a id="back-to-top" href="#" class="text-sm text-muted transition-colors hover:text-ink">Back to top
            &uarr;</a>
        </div>

        <div
          class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-line pt-6 text-sm text-faint">
          <span>&copy; <span id="year">2026</span> Blessed Zulu</span>
          <nav class="flex gap-5 text-muted">
            <a href="https://github.com/blessedzulu" target="_blank" rel="noopener"
              class="transition-colors hover:text-ink">GitHub</a>
            <a href="https://www.linkedin.com/in/blessedzulu" target="_blank" rel="noopener"
              class="transition-colors hover:text-ink">LinkedIn</a>
            <a href="https://x.com/blessedzulu_" target="_blank" rel="noopener"
              class="transition-colors hover:text-ink">X</a>
          </nav>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>
