---
title: Work
description: Selected projects, client systems and open-source work by Blessed Zulu — mostly Laravel, PHP and mobile.
---
@extends('_layouts.main')

@php
    // Single source of truth for the work index. Add an item to a group's list
    // to extend it. `meta` chips render in mono; `status` shows a pill (with a
    // pulsing dot when it reads "In progress"). `url` is optional - items without
    // one render as plain rows (no external link, no hover arrow).
    $groups = [
        [
            'label' => 'Projects',
            'note' => 'Products I own and run.',
            'items' => [
                [
                    'name' => 'Zamcalc',
                    'blurb' => 'A financial calculator suite for Zambia - PAYE and NAPSA deductions, ZESCO tariffs, mobile-money fees and 25+ tools, on web, Android and iOS.',
                    'meta' => ['Founder & Engineer', 'Web · Android · iOS', 'Laravel', 'Livewire', 'NativePHP'],
                    'status' => 'Live',
                    'url' => 'https://zamcalc.com',
                    'urlLabel' => 'zamcalc.com',
                ],
            ],
        ],
        [
            'label' => 'Client Work',
            'note' => 'Systems built for universities and businesses.',
            'items' => [
                [
                    'name' => 'Student Management System',
                    'blurb' => 'A student management platform for Zambia University College of Technology - enrolment, student records and administration.',
                    'meta' => ['Engineer', 'Web', 'ZUCT'],
                    'status' => 'Live',
                    'url' => 'https://sms.zut.ac.zm',
                    'urlLabel' => 'sms.zut.ac.zm',
                ],
                [
                    'name' => 'Zambia University College of Technology',
                    'blurb' => 'The institutional website for Zambia University College of Technology - the college\'s public online presence.',
                    'meta' => ['Engineer', 'Web', 'ZUCT'],
                    'status' => 'Live',
                    'url' => 'https://zut.ac.zm',
                    'urlLabel' => 'zut.ac.zm',
                ],
                [
                    'name' => 'CBU Atlas',
                    'blurb' => 'A student information system for The Copperbelt University - records, registration and academic administration.',
                    'meta' => ['Engineer', 'Web', 'CBU'],
                    'status' => 'In progress',
                    'url' => null,
                    'urlLabel' => null,
                ],
                [
                    'name' => 'Macroworld Services',
                    'blurb' => 'The corporate website for Macroworld Services - brand presence and online storefront.',
                    'meta' => ['Engineer', 'Web'],
                    'status' => 'Live',
                    'url' => 'https://macroworldservices.com',
                    'urlLabel' => 'macroworldservices.com',
                ],
                [
                    'name' => 'Fleet Monitoring Platform',
                    'blurb' => 'A fleet monitoring platform for Macroworld Services - tracking and reporting across a vehicle fleet.',
                    'meta' => ['Engineer', 'Web', 'Macroworld Services'],
                    'status' => 'Live',
                    'url' => 'https://fleet.macroworldservices.com',
                    'urlLabel' => 'fleet.macroworldservices.com',
                ],
            ],
        ],
        [
            'label' => 'Open Source',
            'note' => 'Packages I maintain for the tools I use.',
            'items' => [
                [
                    'name' => 'NativePHP AdMob',
                    'blurb' => 'Google AdMob for NativePHP Mobile - banner, interstitial, rewarded and app-open ads, with UMP consent and iOS App Tracking Transparency.',
                    'meta' => ['Author & Maintainer', 'PHP · NativePHP', 'blessedzulu/nativephp-admob'],
                    'status' => null,
                    'url' => 'https://github.com/blessedzulu/nativephp-admob',
                    'urlLabel' => 'View on GitHub',
                ],
                [
                    'name' => 'NativePHP Haptics',
                    'blurb' => 'Haptic feedback for NativePHP Mobile - impact, notification and selection styles, plus custom vibration patterns.',
                    'meta' => ['Author & Maintainer', 'PHP · NativePHP', 'blessedzulu/nativephp-mobile-haptics'],
                    'status' => null,
                    'url' => 'https://github.com/blessedzulu/nativephp-mobile-haptics',
                    'urlLabel' => 'View on GitHub',
                ],
                [
                    'name' => 'NativePHP Deep Links',
                    'blurb' => 'Deep-link hardening for NativePHP Mobile - scopes Android App Links to specific path prefixes and preserves array query params through the WebView bridge.',
                    'meta' => ['Author & Maintainer', 'PHP · NativePHP', 'blessedzulu/nativephp-deeplinks'],
                    'status' => null,
                    'url' => 'https://github.com/blessedzulu/nativephp-deeplinks',
                    'urlLabel' => 'View on GitHub',
                ],
            ],
        ],
    ];

    $total = collect($groups)->sum(fn ($g) => count($g['items']));
    $n = 0;
@endphp

@section('body')
<main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">

        {{-- header --}}
        <header class="reveal">
            <p class="font-mono text-xs uppercase tracking-[0.2em] text-faint">Selected Work</p>
            <h1 class="mt-5 font-serif text-4xl leading-[1.04] sm:text-6xl">Things I've built,<br>and keep building.</h1>
            <p class="mt-6 max-w-xl text-lg leading-relaxed text-muted">
                Products I own, systems I've built for clients, and open-source packages for the
                frameworks I use. Ambitious websites, apps and systems - mostly Laravel and PHP,
                shipped end to end.
            </p>
            <p class="mt-8 font-mono text-xs uppercase tracking-[0.2em] text-faint">
                {{ sprintf('%02d', $total) }} entries &middot; {{ count($groups) }} categories
            </p>
        </header>

        {{-- groups --}}
        <div class="mt-16 space-y-20 sm:mt-24 sm:space-y-28">
            @foreach ($groups as $group)
                <section class="reveal">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-6 gap-y-1 border-b border-line pb-4">
                        <h2 class="font-mono text-xs uppercase tracking-[0.2em] text-ink">{{ $group['label'] }}</h2>
                        <span class="text-sm text-faint">{{ $group['note'] }}</span>
                    </div>

                    <div>
                        @foreach ($group['items'] as $item)
                            @php $n++; $tag = $item['url'] ? 'a' : 'div'; @endphp
                            <{{ $tag }}
                                @if ($item['url']) href="{{ $item['url'] }}" target="_blank" rel="noopener" @endif
                                class="group relative grid grid-cols-[2rem_1fr] gap-x-4 border-b border-line py-8 sm:grid-cols-[3rem_1fr] sm:gap-x-8 sm:py-10">

                                {{-- index gutter --}}
                                <span class="pt-1.5 font-mono text-xs text-faint tabular-nums">{{ sprintf('%02d', $n) }}</span>

                                <div>
                                    <div class="flex items-start justify-between gap-4">
                                        <h3 class="font-serif text-2xl leading-tight text-ink sm:text-[1.75rem]">
                                            <span class="bg-gradient-to-r from-current to-current bg-[length:0%_1px] bg-left-bottom bg-no-repeat transition-[background-size] duration-300 ease-out group-hover:bg-[length:100%_1px]">{{ $item['name'] }}</span>
                                        </h3>

                                        @if ($item['status'])
                                            <span class="mt-1.5 inline-flex shrink-0 items-center gap-1.5 rounded-full border border-line px-2.5 py-1 font-mono text-[0.65rem] uppercase tracking-wider text-faint">
                                                @if ($item['status'] === 'In progress')
                                                    <span class="relative flex h-1.5 w-1.5" aria-hidden="true">
                                                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-ink/50"></span>
                                                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-ink/70"></span>
                                                    </span>
                                                @endif
                                                {{ $item['status'] }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="mt-3 max-w-xl leading-relaxed text-muted">{{ $item['blurb'] }}</p>

                                    <div class="mt-5 flex flex-wrap gap-2">
                                        @foreach ($item['meta'] as $chip)
                                            <span class="rounded-full border border-line px-2.5 py-1 font-mono text-[0.65rem] uppercase tracking-wider text-faint">{{ $chip }}</span>
                                        @endforeach
                                    </div>

                                    @if ($item['url'])
                                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm text-muted transition-colors group-hover:text-ink">
                                            {{ $item['urlLabel'] }}
                                            <span class="transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">&nearr;</span>
                                        </span>
                                    @endif
                                </div>
                            </{{ $tag }}>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        {{-- closing note --}}
        <div class="reveal mt-20 sm:mt-28">
            <p class="max-w-xl font-serif text-2xl leading-snug text-ink sm:text-3xl">
                Have something that needs building?
            </p>
            <a href="/contact" class="mt-4 inline-flex items-center gap-1.5 text-muted transition-colors hover:text-ink">
                <span class="u">Let's talk</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>
</main>
@endsection
