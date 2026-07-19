---
title: About
description: Blessed Zulu is a software engineer in Ndola, Zambia, building products, client systems and open-source tools with Laravel and PHP.
---
@extends('_layouts.main')

@php
  $principles = [
      [
          'title' => 'Ambitious, end to end',
          'note' =>
              'I tackle real, hard problems, building complete products and software systems from plan to launch.',
      ],
      [
          'title' => 'Built for real people',
          'note' => 'I build software that is used on real-world devices, designed to be fast, robust and reliable.',
      ],
      [
          'title' => 'Accurate by default',
          'note' => 'A lot of my work concerns finances and sensitive records. It has to be accurate and trustworthy.',
      ],
  ];

  // Capabilities, not tooling - a client cares what gets built, not the stack.
  $help = [
      [
          'title' => 'Product & full-stack engineering',
          'note' => 'From an idea or vision to complete software that real people use.',
      ],
      ['title' => 'Websites & web apps', 'note' => 'Marketing sites, internal tools and platforms a business runs on.'],
      ['title' => 'Mobile apps', 'note' => 'For iOS and Android, shipped reliably from a cross-platform codebase.'],
      [
          'title' => 'Growth strategy',
          'note' => 'SEO, GEO, analytics and the technical work behind steady product growth.',
      ],
  ];
@endphp

@section('body')
  <main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">

      @include('_partials.page-header', [
          'eyebrow' => 'About',
          'title' => 'I build software people rely on.',
      ])

      {{-- intro prose. Deliberately does not restate the title or the
             principles below - it covers who, where and range only. --}}
      <div class="mt-10 max-w-2xl space-y-6 text-lg leading-relaxed text-soft">
        <p>
          I'm Blessed Zulu, a software engineer in Ndola, Zambia. My work spans products I own and
          run, systems built for universities and businesses, and open-source packages I maintain
          for the tools I use every day.
        </p>
        <p>
          I work mostly in Laravel and PHP, though the stack matters far less to me than whether
          a software product holds up once it's carrying weight.
        </p>
      </div>

      {{-- how I work --}}
      <section class="mt-16 sm:mt-24">
        <h2 class="mb-8 font-mono text-xs uppercase tracking-[0.2em] text-ink">How I work</h2>
        <div class="grid gap-4 sm:grid-cols-3">
          @foreach ($principles as $i => $p)
            <div class="rounded-2xl bg-paper-2 p-6 sm:p-7">
              <span class="font-mono text-xs text-faint tabular-nums">{{ sprintf('%02d', $i + 1) }}</span>
              <p class="mt-3 font-serif text-xl text-ink">{{ $p['title'] }}</p>
              <p class="mt-1.5 text-muted">{{ $p['note'] }}</p>
            </div>
          @endforeach
        </div>
      </section>

      {{-- what I can help with. Deliberately a light two-column list, not cards:
           a second numbered card grid under "How I work" would read as repetition. --}}
      <section class="mt-16 sm:mt-24">
        <h2 class="mb-2 font-mono text-xs uppercase tracking-[0.2em] text-ink">What I can help with</h2>
        <div class="grid sm:grid-cols-2 sm:gap-x-10">
          @foreach ($help as $h)
            <div class="border-t border-line py-5">
              <p class="font-serif text-xl text-ink">{{ $h['title'] }}</p>
              <p class="mt-1.5 text-muted">{{ $h['note'] }}</p>
            </div>
          @endforeach
        </div>
      </section>

      {{-- stack --}}
      <section class="mt-16 sm:mt-24">
        <h2 class="mb-6 font-mono text-xs uppercase tracking-[0.2em] text-ink">The tools I use</h2>
        <div class="flex flex-wrap gap-2">
          @foreach ($page->stack as $tech)
            <span
              class="rounded-full border border-line px-3 py-1.5 font-mono text-xs uppercase tracking-wider text-faint">{{ $tech }}</span>
          @endforeach
        </div>
      </section>

      {{-- CTA --}}
      <div class="mt-16 sm:mt-24">
        <p class="max-w-xl font-serif text-2xl leading-snug text-ink sm:text-3xl">
          Working on something interesting?
        </p>
        <a href="/contact" class="action -ml-3 mt-4 inline-flex items-center gap-1.5 px-3 py-1.5 text-muted">
          Get in touch
          <span aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </div>
  </main>
@endsection
