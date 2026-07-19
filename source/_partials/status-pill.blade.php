{{--
    Status badge (mono, all-caps). "Live" is the implicit default and shows
    nothing; only a genuinely noteworthy status (e.g. "In progress") is badged.
    Expects:
      $status  e.g. 'In progress', 'Live', or null
      $class   optional extra classes (e.g. alignment)
--}}
@php $s = $status ?? null; @endphp
@if ($s && strtolower($s) !== 'live')
    <span class="inline-flex shrink-0 items-center rounded-full border border-line px-2.5 py-1 font-mono text-[0.65rem] uppercase tracking-wider text-faint {{ $class ?? '' }}">{{ $s }}</span>
@endif
