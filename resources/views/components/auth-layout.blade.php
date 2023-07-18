<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ Breadcrumbs::generate()->pluck("title")->implode(" | ") ." | " . config("app.name") }}</title>

        @vite(["resources/css/app.css", "resources/js/app.js"])
        @stack("head")
        @livewireStyles
        @livewireScripts
    </head>
    <body class="antialiased" x-data="{ sidebarOpen: false }">
        <x-sidebar />

        <div :class="sidebarOpen ? 'md:ml-64' : ''" class="flex w-full items-center justify-between px-6 lg:px-8">
            <div class="flex items-center">
                <button
                    id="sidebar-toggle"
                    @click="sidebarOpen = !sidebarOpen"
                    x-cloak
                    class="text-gray-500 transition-colors duration-150 hover:text-gray-800"
                >
                    @svg('heroicon-s-menu', 'h-6 w-6')
                </button>
                <ul class="my-4 flex items-center space-x-2 pl-4 text-sm font-medium text-gray-500">
                    @foreach (Breadcrumbs::generate() as $item)
                        <li>
                            <a
                                href="{{ $item->url }}"
                                @class([
                                    "text-gray-900" => $loop->last,
                                    "font-medium text-gray-500 transition-colors duration-150 hover:text-gray-700" => ! $loop->last,
                                ])
                            >
                                {{ $item->title }}
                            </a>
                        </li>
                        @if (! $loop->last)
                            <li>
                                <span class="text-gray-300">/</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <livewire:notifications-bell />
        </div>

        <main
            :class="sidebarOpen ? 'md:ml-64' : ''"
            class="flex min-h-screen flex-col items-center justify-center bg-white sm:px-6 md:bg-gray-200 md:py-8 lg:px-8"
        >
            {{ $slot }}
        </main>
        @stack("scripts")
        @livewire("notifications")
    </body>
</html>
