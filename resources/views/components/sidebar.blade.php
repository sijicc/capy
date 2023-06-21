<div class="absolute flex h-screen z-40" x-show="sidebarOpen" x-cloak>
    <div class="flex w-64 flex-shrink-0 flex-col border-r bg-white relative">
        <button @click="sidebarOpen = !sidebarOpen"
                x-cloak
                class="absolute right-2 top-[1.875rem] z-50 text-gray-500 transition-colors duration-150 hover:text-gray-800"
        >
            @svg('heroicon-m-chevron-left', 'h-6 w-6')
        </button>
        <div class="flex h-24 flex-shrink-0 items-center justify-center border-b">
            <a href="{{ route('dashboard') }}">
                @svg('heroicon-m-moon', 'h-16 w-16 text-indigo-600')
                <span class="text-lg font-semibold uppercase tracking-wider text-gray-600 flex justify-center">
                    {{ config('app.name') }}
                </span>
            </a>
        </div>
        <nav class="flex-1 overflow-y-auto bg-white">
            <ul class="py-4">
                <x-menu-item href="#">
                    {{ __('Dashboard') }}
                </x-menu-item>
                <x-menu-item :href="route('users.index')">
                    {{ __('Users') }}
                </x-menu-item>
                <x-menu-item :href="route('companies.index')">
                    {{ __('Companies') }}
                </x-menu-item>
                <x-menu-item :href="route('invoices.index')">
                    {{ __('Invoices') }}
                </x-menu-item>
            </ul>
        </nav>
    </div>
</div>
