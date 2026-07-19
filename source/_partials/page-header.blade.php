{{--
    Standard page header - used by every top-level page for a consistent
    structure (eyebrow → serif title → optional intro → optional meta).
    Expects:
      $eyebrow  short label, rendered all-caps mono (e.g. 'Work')
      $title    the display title; may contain simple HTML such as <br>
      $intro    optional lead paragraph (plain text)
      $meta     optional small mono line beneath the header (plain text)
--}}
<header>
    <p class="font-mono text-xs uppercase tracking-[0.2em] text-faint">{{ $eyebrow }}</p>
    {{-- Title sizing matches the home hero (max-w-xl + text-[2rem]/sm:text-5xl) for consistency. --}}
    <h1 class="mt-5 max-w-xl font-serif text-[2rem] leading-[1.12] sm:text-5xl sm:leading-[1.08]">{!! $title !!}</h1>
    @isset($intro)
        <p class="mt-6 max-w-xl text-lg leading-relaxed text-muted">{{ $intro }}</p>
    @endisset
    @isset($meta)
        <p class="mt-8 font-mono text-xs uppercase tracking-[0.2em] text-faint">{{ $meta }}</p>
    @endisset
</header>
