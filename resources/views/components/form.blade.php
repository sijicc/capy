@php
    if(!isset($method)) {
        $method = 'POST';
    }

    $formMethod = in_array($method, ['PUT', 'PATCH', 'DELETE']) ? 'POST' : $method;
@endphp
<form action="{{ $action }}"
      method="{{ $formMethod }}"
    {{ $attributes }}
>
    @csrf
    @if(!in_array($method, ['GET', 'POST']))
        @method($method)
    @endif
    {{ $slot }}
</form>
