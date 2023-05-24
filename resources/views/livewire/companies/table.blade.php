<x-table>
    <x-slot:head>
        <x-table.heading>{{ __('Name') }}</x-table.heading>
        <x-table.heading>{{ __('NIP') }}</x-table.heading>
        <x-table.heading>{{ __('REGON') }}</x-table.heading>
        <x-table.heading>{{ __('Website') }}</x-table.heading>
        <x-table.heading>{{ __('Created') }}</x-table.heading>
        <x-table.heading>{{ __('Updated') }}</x-table.heading>
        <x-table.heading class="text-right">{{ __('Actions') }}</x-table.heading>
    </x-slot:head>
    <x-slot:body>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->nip }}</td>
                <td>{{ $company->regon }}</td>
                <td>{{ $company->website }}</td>
                <td>{{ $company->created_at->format('d.m.Y H:i:s') }}</td>
                <td>{{ $company->updated_at->format('d.m.Y H:i:s') }}</td>
                <td class="flex justify-end">
                    <x-button type="link" :href="route('companies.edit', $company)"
                              class="text-indigo-600 hover:text-indigo-900">
                        {{ __('Edit') }}
                    </x-button>
                    <x-button type="link" wire:click="confirmDelete({{ $company->id }})"
                              class="text-red-600 hover:text-red-900">
                        {{ __('Delete') }}
                    </x-button>
                </td>
            </tr>
        @endforeach
    </x-slot:body>
</x-table>
