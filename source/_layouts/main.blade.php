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

  {{-- meta, Open Graph, Twitter, JSON-LD - all config-driven --}}
  @include('_partials.head-seo')

  <meta name="theme-color" content="#ffffff">
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
  {{-- iOS home screen; without this, Safari screenshots the page instead --}}
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
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

  {{-- Sticky header. Everything floats bare - no bar, no pill, no backdrop.
       Just the wordmark, the links and the toggle over the page. --}}
  <header id="site-header" class="sticky top-0 z-30">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 flex items-center justify-between h-20">
      <a href="/"
        class="chip action-hover inline-flex h-9 items-center px-4 font-serif text-xl tracking-tight shrink-0 backdrop-blur"
        aria-label="{{ $page->site['name'] }} - home">
        {{-- Split into kept initials + collapsible runs so "Blessed Zulu" folds
             in place to "BZ" on scroll. Kept on one line: any whitespace between
             these spans would render as a gap that cannot collapse. --}}
        @php $wmWords = preg_split('/\s+/', trim($page->site['name'])); @endphp
        <span data-wm>@foreach ($wmWords as $i => $word)@if ($i > 0)<span data-wm-collapse>&nbsp;</span>@endif<span>{{ mb_substr($word, 0, 1) }}</span><span data-wm-collapse>{{ mb_substr($word, 1) }}</span>@endforeach</span>
      </a>

      {{-- Option-2 prototype: pills by default. Three chips (wordmark above, nav
           links, toggle), each a faint tint + backdrop-blur for legibility over
           content. The sliding hover pill lives inside the nav chip; the toggle
           strengthens its own fill on hover. --}}
      <div class="flex items-center gap-1 sm:gap-3">
        <nav data-nav class="chip relative flex h-9 items-center backdrop-blur" aria-label="Primary">
          <span data-nav-indicator aria-hidden="true"
            class="pointer-events-none absolute top-1/2 -translate-y-1/2 rounded-full opacity-0"></span>
          @foreach ($page->nav as $link)
            <a href="{{ $link['url'] }}" data-nav-link
              class="relative z-10 inline-flex h-full items-center px-3 text-sm text-muted hover:text-ink transition-colors sm:px-4">{{ $link['label'] }}</a>
          @endforeach
        </nav>
        <button id="theme-toggle" type="button" aria-label="Toggle dark mode"
          class="chip action-hover inline-flex h-9 w-9 shrink-0 cursor-pointer items-center justify-center text-muted hover:text-ink transition-colors backdrop-blur">
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
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-faint">Get in touch</p>
            <a href="mailto:{{ $page->person['email'] }}"
              class="mt-4 inline-block font-serif text-3xl u sm:text-4xl">{{ $page->person['email'] }}</a>
            <p class="mt-4 max-w-md text-muted">Available for work and collaborations.</p>
          </div>
          <a id="back-to-top" href="#" class="action -mr-3 px-3 py-1.5 text-sm text-muted">Back to top &uarr;</a>
        </div>

        <div
          class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-line pt-6 text-sm text-faint">
          <span>&copy; <span id="year">{{ date('Y') }}</span> {{ $page->site['name'] }}</span>
          <nav data-nav class="relative -mr-3 flex items-center gap-1 text-muted" aria-label="Social">
            <span data-nav-indicator aria-hidden="true"
              class="pointer-events-none absolute top-1/2 -translate-y-1/2 rounded-full opacity-0"></span>
            @foreach ($page->socials as $social)
              <a href="{{ $social['url'] }}" target="_blank" rel="noopener" data-nav-link
                class="relative z-10 px-3 py-1.5 transition-colors hover:text-ink">{{ $social['label'] }}</a>
            @endforeach
          </nav>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>
