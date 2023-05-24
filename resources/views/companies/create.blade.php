<x-auth-layout :title="[
    ['name' => __('Companies'), 'route' => route('companies.index')],
    ['name' => __('Create'), 'route' => route('companies.create')]
    ]">
    <livewire:companies.create />
</x-auth-layout>
