@php
    $tag = isset($href) ? 'a' : 'button';
    $classes = match($type ?? null) {
        'secondary' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white',
        'warning' => 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500 text-white',
        'success' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500 text-white',
        'info' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 text-white',
        'light' => 'bg-gray-100 hover:bg-gray-200 focus:ring-gray-100',
        'dark' => 'bg-gray-800 hover:bg-gray-900 focus:ring-gray-800 text-white',
        'link' => 'text-indigo-600 hover:text-indigo-500 focus:ring-indigo-500',
        'primary-outline' => 'bg-transparent border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white focus:ring-indigo-500',
        'secondary-outline' => 'bg-transparent border border-gray-600 text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-500',
        'danger-outline' => 'bg-transparent border border-red-600 text-red-600 hover:bg-red-600 hover:text-white focus:ring-red-500',
        'warning-outline' => 'bg-transparent border border-yellow-600 text-yellow-600 hover:bg-yellow-600 hover:text-white focus:ring-yellow-500',
        'success-outline' => 'bg-transparent border border-green-600 text-green-600 hover:bg-green-600 hover:text-white focus:ring-green-500',
        'info-outline' => 'bg-transparent border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white focus:ring-blue-500',
        'light-outline' => 'bg-transparent border border-gray-100 text-gray-100 hover:bg-gray-100 hover:text-gray-800 focus:ring-gray-100',
        'dark-outline' => 'bg-transparent border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white focus:ring-gray-800',
        default => 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 text-white',
    }
@endphp
<{{ $tag }}
    @class([
        'relative inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2',
        $classes,
        $attributes->get('class'),
    ])
    {{ $attributes->except('class') }}
>
    {{ $prependIcon ?? null }}
    {{ $slot }}
    {{ $appendIcon ?? null }}
</{{ $tag }}>
