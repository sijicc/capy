@props(['name', 'label', 'value' => null, 'checked' => false, 'disabled' => false])
<div class="flex items-center">
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        @class([
            'form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out rounded' => true,
            'border-gray-300 focus:border-indigo-300 focus:shadow-outline-indigo' => ! $disabled,
            'border-gray-300 focus:border-indigo-300 focus:shadow-outline-indigo' => ! $disabled && ! $checked,
            'border-indigo-300 focus:border-indigo-300 focus:shadow-outline-indigo' => ! $disabled && $checked,
            'border-gray-300 bg-gray-200 cursor-not-allowed' => $disabled,
            'border-gray-300 bg-gray-200 cursor-not-allowed' => $disabled && ! $checked,
            'border-indigo-300 bg-indigo-200 cursor-not-allowed' => $disabled && $checked,
            ])
        {{ $attributes->except('class') }}
    />
    <label for="{{ $name }}" @class([
        'ml-2 block text-sm leading-5 text-gray-900 font-medium' => true,
        'cursor-not-allowed' => $disabled,
        'required' => $attributes->get('required'),
])>
        {{ $label }}
    </label>
</div>

