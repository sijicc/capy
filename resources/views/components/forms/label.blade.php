<label for="{{ $for }}"
    @class([
            'block text-sm font-medium text-gray-700',
            $attributes->get('class'),
    ])
    {{ $attributes->except('class') }}
>
    {{ $value ?? $slot }}
</label>
