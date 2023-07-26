<x-form-wrapper :cancel-button-url="route('users.index')">
    <x-slot name="heading">{{ __("Create user") }}</x-slot>

    {{ $this->form }}
</x-form-wrapper>
