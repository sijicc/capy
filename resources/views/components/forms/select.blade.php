<select
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    @class([
        'block w-full shadow-sm sm:text-sm rounded-md',
        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
        'border-red-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50' => count($errors->get($name)),
        $attributes->get('class'),
    ])
    {{ $attributes->except(['class', 'options']) }}
>
    @foreach($options as $key => $value)
        <option value="{{ $key }}" {{ ($selected ?? null) == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>
@if(count($errors->get($name)))
    <ul class="ml-4 mt-2 text-xs text-red-600 list-disc" id="{{ $id ?? $name }}-error">
        @foreach($errors->get($name) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
