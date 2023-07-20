<x-form-wrapper :cancel-button-url="route('announcements.index')">
    <x-slot name="heading">
        {{ __("Edit announcement") }}
    </x-slot>
    <x-slot name="subheading">
        {{ __("Here you can edit an announcement.") }}
    </x-slot>

    {{ $this->form }}
</x-form-wrapper>
