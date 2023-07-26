@php
    $tag = isset($href) ? "a" : "button";
    $classes = match ($color ?? null) {
        "secondary" => "bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500",
        "danger" => "bg-red-600 text-white hover:bg-red-700 focus:ring-red-500",
        "warning" => "bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500",
        "success" => "bg-green-600 text-white hover:bg-green-700 focus:ring-green-500",
        "info" => "bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500",
        "light" => "bg-gray-100 hover:bg-gray-200 focus:ring-gray-100",
        "dark" => "bg-gray-800 text-white hover:bg-gray-900 focus:ring-gray-800",
        "link" => "text-primary-600 hover:text-primary-500 focus:ring-primary-500",
        "primary-outline" => "border border-primary-600 bg-transparent text-primary-600 hover:bg-primary-600 hover:text-white focus:ring-primary-500",
        "secondary-outline" => "border border-gray-600 bg-transparent text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-500",
        "danger-outline" => "border border-red-600 bg-transparent text-red-600 hover:bg-red-600 hover:text-white focus:ring-red-500",
        "warning-outline" => "border border-yellow-600 bg-transparent text-yellow-600 hover:bg-yellow-600 hover:text-white focus:ring-yellow-500",
        "success-outline" => "border border-green-600 bg-transparent text-green-600 hover:bg-green-600 hover:text-white focus:ring-green-500",
        "info-outline" => "border border-blue-600 bg-transparent text-blue-600 hover:bg-blue-600 hover:text-white focus:ring-blue-500",
        "light-outline" => "border border-gray-100 bg-transparent text-gray-100 hover:bg-gray-100 hover:text-gray-800 focus:ring-gray-100",
        "dark-outline" => "border border-gray-800 bg-transparent text-gray-800 hover:bg-gray-800 hover:text-white focus:ring-gray-800",
        default => "bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500",
    }
@endphp

<{{ $tag }}
    {{ $attributes->twMerge($classes, "relative inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2") }}
    {{ $attributes->except("class") }}
    @if(isset($href))
    wire:navigate
    @endif
>
    {{ $prependIcon ?? null }}
    {{ $slot }}
    {{ $appendIcon ?? null }}
</{{ $tag }}>
