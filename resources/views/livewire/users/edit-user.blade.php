<x-form-wrapper :cancel-button-url="route('announcements.index')">
    <x-slot name="heading">{{ __("Edit User") }}</x-slot>

    {{ $this->form }}
</x-form-wrapper>
