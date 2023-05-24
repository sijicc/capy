<x-auth-layout :title="[
    ['name' => __('Companies'), 'route' => route('companies.index')],
    ['name' => __('Edit'), 'route' => route('companies.edit', $company)]
    ]">
    <livewire:companies.edit :company="$company->getAttributes()" />
</x-auth-layout>
