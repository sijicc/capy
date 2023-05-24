<input
    type="{{ $type ?? 'text' }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ $value ?? old($name) }}"
    @class([
        'block w-full shadow-sm sm:text-sm rounded-md',
        'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
        'border-red-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50' => count($errors->get($name)),
        $attributes->get('class'),
    ])
    {{ $attributes->except('class') }}
>
@if(count($errors->get($name)))
    <ul class="ml-4 mt-2 text-xs text-red-600 list-disc" id="{{ $id ?? $name }}-error">
        @foreach($errors->get($name) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
