@extends('_layouts.main')

@section('body')
  {{-- BZ fluid backdrop (adapted from javierbyte/fluid-triangle, MIT) --}}
  <canvas id="fluid-canvas" aria-hidden="true"></canvas>
  <div class="render" aria-hidden="true"></div>
  <div class="fluid-mask" aria-hidden="true"></div>

  {{-- hero: copy sits up top, the fluid flows in the space beneath it --}}
  <section id="hero" class="relative z-10 flex items-start" style="min-height: calc(100svh - 5rem);">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 w-full pt-14 sm:pt-20">
      <p class="font-serif text-[2rem] leading-[1.12] sm:text-5xl sm:leading-[1.08] max-w-xl reveal text-ink">
        <span class="text-muted">Software Engineer from Zambia.</span>
        <br> Building <em>useful</em> apps and systems for <em>real</em> people and businesses.
      </p>
      <p class="mt-6 text-muted max-w-md reveal tabular-nums">
        Ndola, Zambia &middot; <span id="local-time">--:--:--</span>
      </p>
    </div>
  </section>

  {{-- content sits on paper and scrolls over the fluid --}}
  <main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8">

      {{-- selected work: a flat, uncategorised shortlist of the big hitters.
           "All work" links to /work, which lists everything, grouped. --}}
      <section id="work" class="pt-20 sm:pt-28 reveal">
        <div class="flex items-baseline justify-between mb-8">
          <p class="text-sm text-faint">Selected Work</p>
          <a href="/work" class="text-sm text-faint hover:text-ink transition-colors u">All work</a>
        </div>

        <div>
          <a href="https://zamcalc.com" target="_blank" rel="noopener"
            class="group flex items-baseline gap-x-4 border-t border-line py-5">
            <span class="flex min-w-0 flex-1 flex-wrap items-baseline gap-x-3 gap-y-1">
              <span class="font-medium text-ink">Zamcalc</span>
              <span class="text-muted">Financial tools for Zambia. Web, Android, iOS.</span>
            </span>
            <span class="shrink-0 text-faint group-hover:text-ink transition-colors whitespace-nowrap">Visit &nearr;</span>
          </a>
          <div class="flex items-baseline gap-x-4 border-t border-line py-5">
            <span class="flex min-w-0 flex-1 flex-wrap items-baseline gap-x-3 gap-y-1">
              <span class="font-medium text-ink">CBU Atlas</span>
              <span class="text-muted">Student information system for The Copperbelt University.</span>
            </span>
            <span class="shrink-0 text-faint whitespace-nowrap">In progress</span>
          </div>
          <a href="https://sms.zut.ac.zm" target="_blank" rel="noopener"
            class="group flex items-baseline gap-x-4 border-t border-line py-5">
            <span class="flex min-w-0 flex-1 flex-wrap items-baseline gap-x-3 gap-y-1">
              <span class="font-medium text-ink">Student Management System</span>
              <span class="text-muted">For Zambia University College of Technology.</span>
            </span>
            <span class="shrink-0 text-faint group-hover:text-ink transition-colors whitespace-nowrap">Visit &nearr;</span>
          </a>
          <a href="https://fleet.macroworldservices.com" target="_blank" rel="noopener"
            class="group flex items-baseline gap-x-4 border-t border-line py-5">
            <span class="flex min-w-0 flex-1 flex-wrap items-baseline gap-x-3 gap-y-1">
              <span class="font-medium text-ink">Fleet Monitoring</span>
              <span class="text-muted">Fleet tracking and reporting for Macroworld Services.</span>
            </span>
            <span class="shrink-0 text-faint group-hover:text-ink transition-colors whitespace-nowrap">Visit &nearr;</span>
          </a>
          <a href="https://github.com/blessedzulu" target="_blank" rel="noopener"
            class="group flex items-baseline gap-x-4 border-t border-b border-line py-5">
            <span class="flex min-w-0 flex-1 flex-wrap items-baseline gap-x-3 gap-y-1">
              <span class="font-medium text-ink">NativePHP packages</span>
              <span class="text-muted">Open-source packages for NativePHP Mobile.</span>
            </span>
            <span class="shrink-0 text-faint group-hover:text-ink transition-colors whitespace-nowrap">Visit &nearr;</span>
          </a>
        </div>
      </section>

      {{-- writing --}}
      <section id="writing" class="pt-20 sm:pt-28 reveal">
        <div class="flex items-baseline justify-between mb-8">
          <p class="text-sm text-faint">Writing</p>
          <a href="/writing" class="text-sm text-faint hover:text-ink transition-colors u">All writing</a>
        </div>
        <div>
          @foreach ($posts->take(3) as $post)
            <a href="{{ $post->getUrl() }}"
              class="group flex flex-wrap items-baseline gap-x-3 gap-y-1 py-5 border-t border-line last:border-b">
              <span
                class="font-medium group-hover:underline underline-offset-4 decoration-line">{{ $post->title }}</span>
              <span class="ml-auto text-faint whitespace-nowrap">{{ date('j M Y', $post->date) }}</span>
            </a>
          @endforeach
        </div>
      </section>

      {{-- contact now lives in the footer (id="contact") --}}

    </div>
  </main>

  <script src="/js/fluid.js" defer></script>
@endsection
