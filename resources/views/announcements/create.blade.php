<x-auth-layout
    :title="[
                    ['name' => __('Announcements'), 'route' => route('announcements.index')],
                    ['name' => __('Create'), 'route' => route('announcements.create')]
        ]"
>
    <livewire:announcements.create />
</x-auth-layout>
