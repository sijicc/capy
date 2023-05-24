<x-auth-layout :title="[
    ['name' => __('Users'), 'route' => route('users.index')],
    ['name' => __('Create'), 'route' => route('users.create')]
    ]">
    <livewire:users.create />
</x-auth-layout>
