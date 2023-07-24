<div class="absolute z-40 flex h-screen" x-show="sidebarOpen">
    <div class="relative flex w-64 flex-shrink-0 flex-col border-r bg-white">
        <button
            @click="sidebarOpen = !sidebarOpen"
            x-cloak
            class="absolute right-2 top-[1.875rem] z-50 text-gray-500 transition-colors duration-150 hover:text-gray-800"
        >
            @svg('heroicon-o-chevron-left', 'h-6 w-6')
        </button>
        <div class="flex h-24 flex-shrink-0 items-center justify-center border-b">
            <a href="{{ route("dashboard") }}">
                @svg('heroicon-s-moon', 'h-16 w-16 text-primary-600')
                <span class="flex justify-center text-lg font-semibold uppercase tracking-wider text-gray-600">
                    {{ config("app.name") }}
                </span>
            </a>
        </div>
        <nav class="flex-1 overflow-y-auto bg-white">
            <ul class="py-4">
                @foreach ($menuItems as $menuItem)
                    {!! $menuItem->render() !!}
                @endforeach
            </ul>
        </nav>
    </div>
</div>
