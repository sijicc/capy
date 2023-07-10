<li>
    <a
        class="flex items-center px-6 py-2 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800"
        @if(count($children) > 0)
            x-data="{ open: false }"
        x-on:click.prevent="open = ! open"
        @else
            href="{{ $href }}"
        @endif
    >
        @if (isset($icon))
            @svg($icon, 'h-5 w-5')
        @endif

        <span class="ml-4">{{ $title }}</span>

        @if (count($children) > 0)
            <span class="ml-auto">
                @svg('heroicon-m-chevron-right', 'h-5 w-5', ['x-show' => '!open', 'x-cloak'])
                @svg('heroicon-m-chevron-down', 'h-5 w-5', ['x-show' => 'open', 'x-cloak'])
            </span>
            <ul class="py-4" x-show="open">
                {{-- @foreach ($children as $menuItem) --}}
                {{-- {!! $menuItem->render() !!} --}}
                {{-- @endforeach --}}
            </ul>
        @endif
    </a>
</li>
