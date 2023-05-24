@php
    $classes = match($type ?? null) {
        'success' => 'bg-green-100 border-l-4 border-green-500 text-green-700',
        'error' => 'bg-red-100 border-l-4 border-red-500 text-red-700',
        'warning' => 'bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700',
        'info' => 'bg-blue-100 border-l-4 border-blue-500 text-blue-700',
        default => 'bg-gray-100 border-l-4 border-gray-500 text-gray-700',
    };
@endphp
<div @class([
    'rounded-md p-4 mb-4',
    $classes,
]) role="alert">
    {{ $slot }}
</div>
