@php
    $classes = "flex items-center px-6 py-2 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800";
    if ($active) {
        $classes .= " bg-primary-100/25 text-gray-800 font-semibold";
    }
@endphp

@if (count($children) > 0)
    <li x-data="{ open: @json($active) }" x-on:click="open = ! open">
        <span class="{{ twMerge($classes) }}">
            @if (isset($icon))
                @svg($icon, 'h-5 w-5')
            @endif

            <span class="ml-4">{{ $title }}</span>

            <span class="ml-auto">
                @svg('heroicon-s-chevron-right', 'h-5 w-5', ['x-show' => '!open', 'x-cloak'])
                @svg('heroicon-s-chevron-down', 'h-5 w-5', ['x-show' => 'open', 'x-cloak'])
            </span>
            <br />
        </span>
        <ul class="pl-4" x-show="open" x-collapse>
            @foreach ($children as $menuItem)
                {!! $menuItem->render() !!}
            @endforeach
        </ul>
    </li>
@else
    <li>
        <a class="{{ twMerge($classes) }}" href="{{ $href }}">
            @if (isset($icon))
                @svg($icon, 'h-5 w-5')
            @endif

            <span class="ml-4">{{ $title }}</span>
        </a>
    </li>
@endif
