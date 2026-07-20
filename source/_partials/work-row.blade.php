{{--
    Full project row for the /work index.
    Expects:
      $item  a project array from config('projects')
      $n     1-based index shown in the gutter

    Layout convention: technologies are the ONLY things rendered as chips.
    Role, platform, client, year and package render as labelled spec columns
    (mono all-caps label above a sans value), so each fact is named rather than
    running together as one grey line.
--}}
@php
    $tag = ! empty($item['url']) ? 'a' : 'div';

    // Spec pairs. Config values are IterableObjects, so build lists via foreach.
    $platforms = [];
    foreach (($item['platforms'] ?? []) as $p) { $platforms[] = $p; }

    // Client leads: it is the headline credential on client work, and putting the
    // longest value first lets it take the full first row before the shorter
    // fields wrap in beside each other.
    $specs = [];
    if (! empty($item['client']))  { $specs[] = ['label' => 'Client',   'value' => $item['client']]; }
    if (! empty($item['role']))    { $specs[] = ['label' => 'Role',     'value' => $item['role']]; }
    if (count($platforms))         { $specs[] = ['label' => 'Platform', 'value' => implode(', ', $platforms)]; }
    if (! empty($item['year']))    { $specs[] = ['label' => 'Year',     'value' => $item['year']]; }
    if (! empty($item['package'])) { $specs[] = ['label' => 'Package',  'value' => $item['package']]; }
@endphp
{{-- On mobile the index stacks above the content; from sm it moves into a gutter. --}}
<{{ $tag }}
    @if (! empty($item['url'])) href="{{ $item['url'] }}" target="_blank" rel="noopener" @endif
    class="group grid gap-y-2 border-b border-line py-8 last:border-b-0 sm:grid-cols-[3rem_1fr] sm:gap-x-8 sm:gap-y-0 sm:py-10">

    <span class="font-mono text-xs text-faint tabular-nums sm:pt-1.5">{{ sprintf('%02d', $n) }}</span>

    <div>
        <div class="flex items-start justify-between gap-4">
            <h3 class="font-serif text-2xl leading-tight text-ink sm:text-[1.75rem]">{{ $item['name'] }}</h3>
            @include('_partials.status-pill', ['status' => $item['status'] ?? null, 'class' => 'mt-1.5'])
        </div>

        {{-- spec columns. flex-wrap (not a fixed grid) so a long client name keeps
             its natural width instead of being squeezed into a narrow column. --}}
        @if (count($specs))
            <div class="mt-4 flex flex-wrap gap-x-10 gap-y-4">
                @foreach ($specs as $s)
                    <div>
                        <p class="font-mono text-[0.65rem] uppercase tracking-wider text-faint">{{ $s['label'] }}</p>
                        <p class="mt-1 text-sm text-muted">{{ $s['value'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <p class="mt-4 max-w-xl leading-relaxed text-muted">{{ $item['blurb'] }}</p>

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
