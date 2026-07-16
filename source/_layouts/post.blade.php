@extends('_layouts.main')

@section('body')
<article class="relative z-10 bg-paper">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 pt-14 sm:pt-20">
        <a href="/writing" class="text-sm text-faint hover:text-ink transition-colors">&larr; Writing</a>
        <p class="mt-10 text-sm text-faint">{{ date('j M Y', $page->date) }}</p>
        <h1 class="font-serif text-4xl sm:text-5xl leading-[1.06] mt-3">{{ $page->title }}</h1>
        <div class="prose mt-10">
            @yield('content')
        </div>
        <div class="mt-16 pt-8 border-t border-line">
            <a href="/writing" class="text-sm text-faint hover:text-ink transition-colors">&larr; All writing</a>
        </div>
    </div>
</article>
@endsection
