---
title: Contact
description: Get in touch with Blessed Zulu - open to freelance work, collaborations and conversations about building things.
---
@extends('_layouts.main')

@php
    $help = [
        ['title' => 'Product & full-stack engineering',   'note' => 'From a first sketch to something real people use.'],
        ['title' => 'Laravel & Livewire web apps',        'note' => 'The stack most of my work is built on.'],
        ['title' => 'Mobile apps with NativePHP',         'note' => 'One Laravel codebase, shipped to iOS and Android.'],
        ['title' => 'Data-heavy & correctness-critical tools', 'note' => 'Calculators, dashboards and systems that have to be right.'],
    ];
@endphp

@section('body')
<main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">

        @include('_partials.page-header', [
            'eyebrow' => 'Contact',
            'title'   => "Let's talk.",
            'intro'   => "I'm open to freelance work, collaborations, or just a good conversation about building things. If you've got something in mind, tell me about it.",
        ])

        {{-- email hero + copy --}}
        <div class="mt-12 border-t border-line pt-10 sm:mt-16">
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-faint">Email me</p>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="mailto:{{ $page->person['email'] }}" class="font-serif text-3xl u sm:text-5xl">{{ $page->person['email'] }}</a>
                <button type="button"
                    data-copy="{{ $page->person['email'] }}" data-copied-label="Copied"
                    class="inline-flex shrink-0 cursor-pointer items-center gap-2 rounded-full border border-line px-4 py-2 text-sm text-muted transition-colors hover:text-ink hover:border-ink/30">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="9" y="9" width="13" height="13" rx="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                    <span data-copy-label>Copy</span>
                </button>
            </div>
        </div>

        {{-- availability + location --}}
        <div class="mt-10 grid overflow-hidden rounded-2xl bg-paper-2 sm:grid-cols-2">
            <div class="p-6 sm:p-8">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-muted">Available for work</p>
                <p class="mt-4 text-muted">Taking on new projects and collaborations. I usually reply within a day.</p>
            </div>
            <div class="border-t border-line p-6 sm:border-l sm:border-t-0 sm:p-8">
                <p class="font-mono text-xs uppercase tracking-[0.2em] text-faint">Based in</p>
                <p class="mt-4 text-ink">{{ $page->person['locality'] }}, {{ $page->person['country'] }}</p>
                <p class="mt-1 text-muted tabular-nums">Local time &middot; <span id="local-time" data-timezone="{{ $page->person['timezone'] }}">--:--:--</span></p>
            </div>
        </div>

        {{-- channels --}}
        <section class="mt-16 sm:mt-24">
            <h2 class="mb-2 font-mono text-xs uppercase tracking-[0.2em] text-ink">Elsewhere</h2>
            <div>
                @foreach ($page->socials as $c)
                    <a href="{{ $c['url'] }}" target="_blank" rel="noopener"
                        class="group flex items-baseline gap-x-4 border-t border-line py-5 last:border-b">
                        <span class="w-24 shrink-0 font-medium text-ink sm:w-32">{{ $c['label'] }}</span>
                        <span class="text-muted transition-colors group-hover:text-ink">{{ $c['handle'] }}</span>
                        <span class="action-g ml-auto inline-flex h-8 w-8 shrink-0 items-center justify-center self-center text-faint group-hover:text-ink">&nearr;</span>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- what I can help with --}}
        <section class="mt-16 sm:mt-24">
            <h2 class="mb-8 font-mono text-xs uppercase tracking-[0.2em] text-ink">What I can help with</h2>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ($help as $i => $h)
                    <div class="rounded-2xl bg-paper-2 p-6 sm:p-7">
                        <span class="font-mono text-xs text-faint tabular-nums">{{ sprintf('%02d', $i + 1) }}</span>
                        <p class="mt-3 font-serif text-xl text-ink">{{ $h['title'] }}</p>
                        <p class="mt-1.5 text-muted">{{ $h['note'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</main>
@endsection
