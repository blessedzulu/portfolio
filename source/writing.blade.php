---
title: Writing
description: Occasional notes on the things I build.
---
@extends('_layouts.main')

@section('body')
<main class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">
        <h1 class="font-serif text-4xl sm:text-5xl">Writing</h1>
        <p class="mt-4 text-muted max-w-md">Occasional notes on the things I build. No schedule.</p>

        <div class="mt-12">
            @foreach ($posts as $post)
                <a href="{{ $post->getUrl() }}"
                   class="group flex flex-wrap items-baseline gap-x-3 gap-y-1 py-5 border-t border-line last:border-b">
                    <span class="font-medium group-hover:underline underline-offset-4 decoration-line">{{ $post->title }}</span>
                    <span class="text-muted hidden sm:inline">{{ $post->description }}</span>
                    <span class="ml-auto text-faint whitespace-nowrap">{{ date('j M Y', $post->date) }}</span>
                </a>
            @endforeach
        </div>
    </div>
</main>
@endsection
