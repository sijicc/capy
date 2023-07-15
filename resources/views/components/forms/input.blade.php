<input
    type="{{ $type ?? "text" }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ $value ?? old($name) }}"
    @class([
        "block w-full rounded-md shadow-sm sm:text-sm",
        "border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50",
        "border-red-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" => count($errors->get($name)),
        $attributes->get("class"),
    ])
    {{ $attributes->except("class") }}
/>
@if (count($errors->get($name)))
    <ul class="ml-4 mt-2 list-disc text-xs text-red-600" id="{{ $id ?? $name }}-error">
        @foreach ($errors->get($name) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
