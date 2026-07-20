---
title: Work
description: Selected projects, client systems and open-source work by Blessed Zulu.
---
@extends('_layouts.main')

@php
  // Everything on this page comes from the `projects` and `projectGroups`
  // lists in config.php - the single source of truth shared with the home
  // page. Add a project there and it shows up here automatically.
  $projects = collect($page->projects);
  $total = $projects->count();
  $n = 0;
@endphp

@section('body')
  <main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">

      @include('_partials.page-header', [
          'eyebrow' => 'Work',
          'title' => "Things I've built, and keep building.",
          'intro' =>
              'Products I own, systems I\'ve built for clients, and open-source contributions for the tools I use ',
          'meta' => sprintf('%02d entries · %02d categories', $total, count($page->projectGroups)),
      ])

      {{-- groups, in the order defined by projectGroups --}}
      <div class="mt-16 space-y-20 sm:mt-24 sm:space-y-28">
        @foreach ($page->projectGroups as $label => $note)
          @php $items = $projects->where('group', $label); @endphp
          @continue($items->isEmpty())

          <section>
            <div class="flex flex-wrap items-baseline justify-between gap-x-6 gap-y-1 border-b border-line pb-4">
              <h2 class="font-mono text-xs uppercase tracking-[0.2em] text-ink">{{ $label }}</h2>
              <span class="text-sm text-faint">{{ $note }}</span>
            </div>

            <div>
              @foreach ($items as $item)
                @php $n++; @endphp
                @include('_partials.work-row', ['item' => $item, 'n' => $n])
              @endforeach
            </div>
          </section>
        @endforeach
      </div>

      {{-- closing note --}}
      <div class="mt-20 sm:mt-28">
        <p class="max-w-xl font-serif text-2xl leading-snug text-ink sm:text-3xl">
          Have something that needs building?
        </p>
        <a href="/contact" class="action -ml-3 mt-4 inline-flex items-center gap-1.5 px-3 py-1.5 text-muted">
          Let's talk
          <span aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </div>
  </main>
@endsection
