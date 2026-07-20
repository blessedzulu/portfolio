@extends('_layouts.main')

@section('body')
  {{-- ASCII fluid backdrop (adapted from javierbyte/fluid-triangle, MIT) --}}
  <canvas id="fluid-canvas" aria-hidden="true"></canvas>
  <div class="render" aria-hidden="true"></div>
  <div class="fluid-mask" aria-hidden="true"></div>

  {{-- hero: copy sits up top, the fluid flows in the space beneath it --}}
  <section id="hero" class="relative z-10 flex items-start" style="min-height: calc(100svh - 5rem);">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 w-full pt-14 sm:pt-20">
      <h1 class="font-serif text-[2rem] leading-[1.12] sm:text-5xl sm:leading-[1.08] max-w-xl text-ink">
        <span class="text-muted">Software Engineer.</span>
        <br> Building <em>useful</em> apps and systems for <em>real</em> people and businesses.
      </h1>
      <p class="mt-6 text-muted max-w-md tabular-nums">
        {{ $page->person['locality'] }}, {{ $page->person['country'] }}<span class="mx-3 text-faint"
          aria-hidden="true">&middot;</span><span id="local-time"
          data-timezone="{{ $page->person['timezone'] }}">--:--:--</span>
      </p>
    </div>
  </section>

  {{-- content sits on paper and scrolls over the fluid --}}
  <main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8">

      {{-- selected work: a curated shortlist of featured projects, drawn from the
           same config list as /work. "All work" links to the full, grouped index. --}}
      <section id="work" class="pt-20 sm:pt-28">
        <div class="flex items-baseline justify-between">
          <h2 class="font-mono text-xs uppercase tracking-[0.2em] text-faint">Selected Work</h2>
          <a href="/work" class="action -mr-3 px-3 py-1.5 text-sm text-faint">All work &rarr;</a>
        </div>

        <div class="mt-8">
          @foreach (collect($page->projects)->where('featured', true) as $item)
            @include('_partials.work-row-compact', ['item' => $item])
          @endforeach
        </div>
      </section>

      {{-- contact lives in the footer (id="contact") --}}

    </div>
  </main>

  {{-- the fluid spells the stack from config (single source of truth) --}}
  @php
    $fluidTechs = [];
    foreach ($page->stack as $t) { $fluidTechs[] = strtolower($t); }
  @endphp
  <script>window.FLUID_TECHS = {!! json_encode(array_values($fluidTechs)) !!};</script>
  <script src="/js/fluid.js" defer></script>
@endsection
