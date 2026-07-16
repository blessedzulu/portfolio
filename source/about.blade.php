---
title: About
description: Blessed Zulu is a software engineer in Ndola, Zambia, building ambitious websites, apps and systems with Laravel and PHP.
---
@extends('_layouts.main')

@php
    $principles = [
        ['title' => 'Ambitious, end to end', 'note' => 'I take on real, hard problems - full products and systems, not just screens - and see them through to shipping.'],
        ['title' => 'Built for real people', 'note' => 'Most of what I build is used in Zambia, so it has to be fast, clear, and work on real-world devices and data.'],
        ['title' => 'Correct by default', 'note' => 'A lot of my work touches money and records. It has to be right - and easy to trust.'],
    ];

    $currently = [
        'Building Zamcalc - financial tools for Zambia, on web, Android and iOS.',
        'Working on CBU Atlas, a student information system for The Copperbelt University.',
        'Maintaining a set of open-source packages for NativePHP Mobile.',
    ];

    $stack = ['Laravel', 'Livewire', 'Tailwind CSS', 'NativePHP', 'PHP', 'MySQL', 'Filament', 'Pest'];
@endphp

@section('body')
<main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">

        {{-- header --}}
        <header class="reveal">
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-faint">About</p>
            <h1 class="mt-5 max-w-2xl font-serif text-4xl leading-[1.06] sm:text-6xl">I build ambitious websites, apps and systems.</h1>
        </header>

        {{-- intro prose --}}
        <div class="reveal mt-10 max-w-2xl space-y-6 text-lg leading-relaxed text-soft">
            <p>
                I'm Blessed Zulu, a software engineer based in Ndola, Zambia. I design and build
                ambitious websites, apps and systems end to end - mostly with Laravel and PHP - and
                I sweat the details that make them feel fast, polished and worth trusting.
            </p>
            <p>
                My work spans products I own, like <a href="https://zamcalc.com" target="_blank" rel="noopener" class="text-ink u">Zamcalc</a>;
                systems I've built for universities and businesses; and open-source packages for
                the frameworks I use every day. I like taking on hard, real problems and shipping
                them all the way into people's hands.
            </p>
        </div>

        {{-- how I work --}}
        <section class="reveal mt-20 sm:mt-28">
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

        {{-- currently --}}
        <section class="reveal mt-20 sm:mt-28">
            <h2 class="mb-2 font-mono text-xs uppercase tracking-[0.2em] text-ink">Currently</h2>
            <div>
                @foreach ($currently as $line)
                    <div class="flex items-baseline gap-x-4 border-t border-line py-5 last:border-b">
                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-ink/60" aria-hidden="true"></span>
                        <p class="text-muted">{{ $line }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- stack --}}
        <section class="reveal mt-20 sm:mt-28">
            <h2 class="mb-6 font-mono text-xs uppercase tracking-[0.2em] text-ink">The stack I reach for</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($stack as $tech)
                    <span class="rounded-full border border-line px-3 py-1.5 font-mono text-xs text-faint">{{ $tech }}</span>
                @endforeach
            </div>
        </section>

        {{-- CTA --}}
        <div class="reveal mt-20 sm:mt-28">
            <p class="max-w-xl font-serif text-2xl leading-snug text-ink sm:text-3xl">
                Working on something I'd find interesting?
            </p>
            <a href="/contact" class="mt-4 inline-flex items-center gap-1.5 text-muted transition-colors hover:text-ink">
                <span class="u">Get in touch</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>
</main>
@endsection
