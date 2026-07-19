{{--
    Full project row for the /work index.
    Expects:
      $item  a project array from config('projects')
      $n     1-based index shown in the gutter

    Layout convention (see item 9 of the polish pass): technologies are the
    ONLY things rendered as chips. Role, platforms, client and package name
    read as a single plain meta line.
--}}
@php
    $tag = ! empty($item['url']) ? 'a' : 'div';

    // Plain meta line - role · platforms · client · package (chips are tech only).
    // Config values are IterableObjects, so build the list via foreach.
    $meta = [];
    if (! empty($item['role']))    { $meta[] = $item['role']; }
    foreach (($item['platforms'] ?? []) as $p) { $meta[] = $p; }
    if (! empty($item['client']))  { $meta[] = $item['client']; }
    if (! empty($item['package'])) { $meta[] = $item['package']; }
@endphp
<{{ $tag }}
    @if (! empty($item['url'])) href="{{ $item['url'] }}" target="_blank" rel="noopener" @endif
    class="group grid grid-cols-[2rem_1fr] gap-x-4 border-b border-line py-8 last:border-b-0 sm:grid-cols-[3rem_1fr] sm:gap-x-8 sm:py-10">

    {{-- index gutter --}}
    <span class="pt-1.5 font-mono text-xs text-faint tabular-nums">{{ sprintf('%02d', $n) }}</span>

    <div>
        <div class="flex items-start justify-between gap-4">
            <h3 class="font-serif text-2xl leading-tight text-ink sm:text-[1.75rem]">{{ $item['name'] }}</h3>
            @include('_partials.status-pill', ['status' => $item['status'] ?? null, 'class' => 'mt-1.5'])
        </div>

        @if (count($meta))
            <p class="mt-2 text-sm text-faint">{{ implode(' · ', $meta) }}</p>
        @endif

        <p class="mt-3 max-w-xl leading-relaxed text-muted">{{ $item['blurb'] }}</p>

        {{-- chips: technologies only --}}
        @if (! empty($item['tech']))
            <div class="mt-5 flex flex-wrap gap-2">
                @foreach ($item['tech'] as $chip)
                    <span class="rounded-full border border-line px-2.5 py-1 font-mono text-[0.65rem] uppercase tracking-wider text-faint">{{ $chip }}</span>
                @endforeach
            </div>
        @endif

        @if (! empty($item['url']))
            <span class="action-g -ml-3 mt-5 inline-flex items-center gap-1.5 px-3 py-1.5 text-sm text-muted transition-colors group-hover:text-ink">
                {{ $item['urlLabel'] }}
                <span class="transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">&nearr;</span>
            </span>
        @endif
    </div>
</{{ $tag }}>
