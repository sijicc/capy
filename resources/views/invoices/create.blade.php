<x-auth-layout :title="[
    ['name' => __('Invoices'), 'route' => route('invoices.index')],
    ['name' => __('Create'), 'route' => route('invoices.create')]
    ]">
    <livewire:invoices.create/>
</x-auth-layout>
