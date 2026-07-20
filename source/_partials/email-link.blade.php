{{--
    Obfuscated email link. The address is never emitted as plaintext in the
    HTML: it is split into data attributes and reassembled by main.js, so the
    naive harvesters that regex for user@domain find nothing to scrape.

    Without JS it degrades to a readable "user (at) domain" rather than a dead
    link. Note the JSON-LD `email` and llms.txt still publish the address in
    full, deliberately - those exist to be machine-readable.

    Expects:
      $class  classes for the <a>
--}}
@php
    [$emailUser, $emailDomain] = explode('@', $page->person['email']);
@endphp
<a data-email="{{ $emailUser }}" data-email-domain="{{ $emailDomain }}"
    class="{{ $class ?? '' }}">{{ $emailUser }} (at) {{ $emailDomain }}</a>
