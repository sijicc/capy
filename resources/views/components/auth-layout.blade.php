<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ collect($title)->pluck('name')->implode(' / ') }} | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    @livewireStyles
</head>
<body class="antialiased" x-data="{sidebarOpen: true}">
<x-sidebar/>

<div :class="sidebarOpen ? 'md:ml-64' : ''" class="pl-6 lg:pl-8 flex items-center">
    <button id="sidebar-toggle" @click="sidebarOpen = !sidebarOpen" x-cloak
            class="text-gray-500 transition-colors duration-150 hover:text-gray-800">
        @svg('heroicon-m-bars-3', 'h-6 w-6')
    </button>
    <ul class="pl-4 my-4 flex items-center text-sm font-medium text-gray-500 space-x-2">
        @foreach($title as $item)
            <li>
                <a href="{{ $item['route'] }}" @class([
                    'text-gray-900' => $loop->last,
                    'text-gray-500' => !$loop->last,
                    'hover:text-gray-700' => !$loop->last,
                    'transition-colors duration-150' => !$loop->last,
                    'font-medium' => !$loop->last,
                ])>
                    {{ $item['name'] }}
                </a>
            </li>
            @if(!$loop->last)
                <li>
                    <span class="text-gray-300">/</span>
                </li>
            @endif
        @endforeach
    </ul>

</div>

<main :class="sidebarOpen ? 'md:ml-64' : ''"
      class="flex min-h-screen flex-col items-center justify-center bg-white sm:px-6 md:bg-gray-200 md:py-8 lg:px-8">

    {{ $slot }}
</main>
@stack('scripts')
@livewireScripts
</body>
