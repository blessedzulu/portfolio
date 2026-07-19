{{--
    Compact project row for the home "Selected Work" shortlist - richer than a
    bare link, lighter than the full /work row. Rows divide with a top border
    so the final row leaves no dangling hairline.
    Expects:
      $item  a project array from config('projects')
--}}
@php
    $tag  = ! empty($item['url']) ? 'a' : 'div';
    // platforms · tech (config values are IterableObjects, so build via foreach)
    $meta = [];
    foreach (($item['platforms'] ?? []) as $p) { $meta[] = $p; }
    foreach (($item['tech'] ?? []) as $t) { $meta[] = $t; }
    $meta = array_filter($meta);
@endphp
<{{ $tag }}
    @if (! empty($item['url'])) href="{{ $item['url'] }}" target="_blank" rel="noopener" @endif
    class="group flex items-start justify-between gap-x-6 border-t border-line py-6">

    <div class="min-w-0">
        <h3 class="font-serif text-xl text-ink sm:text-2xl">{{ $item['name'] }}</h3>
        <p class="mt-1 text-muted">{{ $item['tagline'] }}</p>
        @if (count($meta))
            <p class="mt-2 text-sm text-faint">{{ implode(' · ', $meta) }}</p>
        @endif
    </div>

    <div class="flex shrink-0 items-center gap-3 pt-1">
        @include('_partials.status-pill', ['status' => $item['status'] ?? null])
        @if (! empty($item['url']))
            <span class="action-g inline-flex h-8 w-8 shrink-0 items-center justify-center text-faint group-hover:text-ink" aria-hidden="true">&nearr;</span>
        @endif
    </div>
</{{ $tag }}>
