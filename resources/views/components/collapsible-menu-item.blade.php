<li x-data="{ open: false }">
    <button
        class="inline-flex w-full items-center px-6 py-2 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800"
        @click="open = !open"
    >
        <span>{{ $title }}</span>
        <svg
            class="ml-auto h-5 w-5"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path x-show="!open" d="M9 5l7 7-7 7"></path>
            <path x-show="open" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <ul x-show="open" class="mt-2 space-y-2 px-7" x-collapse>
        {{ $slot }}
    </ul>
</li>
