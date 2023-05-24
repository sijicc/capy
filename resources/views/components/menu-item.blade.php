<li>
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline flex items-center px-6 py-2 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800']) }}
        <span class="ml-4">{{ $slot }}</span>
    </a>
</li>
