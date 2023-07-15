@props([
    "name",
    "label",
    "value" => null,
    "checked" => false,
    "disabled" => false,
])
<div class="flex items-center">
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        @class([
            "form-checkbox h-4 w-4 rounded text-primary-600 transition duration-150 ease-in-out" => true,
            "focus:shadow-outline-primary border-gray-300 focus:border-primary-300" => ! $disabled,
            "focus:shadow-outline-primary border-gray-300 focus:border-primary-300" => ! $disabled && ! $checked,
            "focus:shadow-outline-primary border-primary-300 focus:border-primary-300" => ! $disabled && $checked,
            "cursor-not-allowed border-gray-300 bg-gray-200" => $disabled,
            "cursor-not-allowed border-gray-300 bg-gray-200" => $disabled && ! $checked,
            "cursor-not-allowed border-primary-300 bg-primary-200" => $disabled && $checked,
        ])
        {{ $attributes->except("class") }}
    />
    <label
        for="{{ $name }}"
        @class([
            "ml-2 block text-sm font-medium leading-5 text-gray-900" => true,
            "cursor-not-allowed" => $disabled,
            "required" => $attributes->get("required"),
        ])
    >
        {{ $label }}
    </label>
</div>
