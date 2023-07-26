<x-form-wrapper :cancel-button-url="route('companies.index')">
    <x-slot name="heading">{{ __("Create Company") }}</x-slot>

    {{ $this->form }}
</x-form-wrapper>
