<div x-data="{
    dropdownOpen: false,
}">
    <div @click="dropdownOpen = ! dropdownOpen">
        @svg('heroicon-s-bell', 'h-6 w-6 text-gray-500 transition-colors duration-150 hover:text-gray-800')
        @if ($this->notifications->whereNull("read_at")->count() > 0)
            <span
                class="absolute right-5 top-3 inline-flex animate-ping items-center justify-center rounded-full bg-primary-600 px-1 py-1 text-xs font-bold leading-none text-red-100"
            />
        @endif
    </div>
    <div
        x-show="dropdownOpen"
        @click.away="dropdownOpen=false"
        x-transition:enter="duration-200 ease-out"
        x-transition:enter-start="-translate-y-2"
        x-transition:enter-end="translate-y-0"
        class="absolute left-[100%] top-0 z-50 mt-12 w-[24rem] -translate-x-[100%]"
        x-cloak
    >
        <div
            class="mt-1 max-h-80 overflow-y-auto rounded-md border border-neutral-200/70 bg-white p-1 text-sm text-neutral-700 shadow-md"
        >
            @if($notifications->whereNull("read_at")->count() > 0)
            <div
                wire:click="markAllAsRead"
                class="group relative w-full cursor-default select-none rounded px-2 py-1.5 text-center outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
            >
                <span class="">
                    {{ __("Mark all as read") }}
                </span>
            </div>
            <hr class="border-neutral-200/70" />
            @endif
            @forelse ($notifications as $notification)
                <div
                    class="group relative w-full cursor-default select-none rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                >
                    <div class="flex items-center justify-between">
                        {!! $notification->data["message"] !!}
                        @if ($notification->read_at)
                            <a wire:click="markAsUnread('{{ $notification->id }}')">
                                @svg("heroicon-s-check-circle", "h-5 w-5 text-green-500 group-hover:text-green-600")
                            </a>
                        @else
                            <a wire:click="markAsRead('{{ $notification->id }}')">
                                @svg("heroicon-s-check-circle", "h-5 w-5 text-gray-400 group-hover:text-gray-500")
                            </a>
                        @endif
                    </div>
                    <div class="text-xs text-neutral-500">
                        {{ __("Created") }}
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                    @if ($notification->read_at)
                        <div class="text-xs text-neutral-500">
                            {{ __("Marked as read") }}
                            {{ $notification->read_at->diffForHumans() }}
                        </div>
                    @endif
                </div>
                <hr class="border-neutral-200/70" />
            @empty
                <div
                    class="group relative w-full cursor-default select-none rounded px-2 py-1.5 outline-none hover:bg-neutral-100 hover:text-neutral-900 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                >
                    <span class="text-sm text-neutral-500">
                        {{ __("No notifications") }}
                    </span>
                </div>
            @endforelse
        </div>
    </div>
</div>
