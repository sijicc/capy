<x-table>
    <x-slot:head>
        <x-table.heading>{{ __('Name') }}</x-table.heading>
        <x-table.heading>{{ __('Email') }}</x-table.heading>
        <x-table.heading>{{ __('Created') }}</x-table.heading>
        <x-table.heading>{{ __('Updated') }}</x-table.heading>
        <x-table.heading class="text-right">{{ __('Actions') }}</x-table.heading>
    </x-slot:head>
    <x-slot:body>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i:s') }}</td>
                <td>{{ $user->updated_at->format('d.m.Y H:i:s') }}</td>
                <td class="flex justify-end">
                    <x-button type="link" :href="route('users.edit', $user)"
                              class="text-indigo-600 hover:text-indigo-900">
                        {{ __('Edit') }}
                    </x-button>
                    <x-button type="link" wire:click="confirmDelete({{ $user->id }})"
                              class="text-red-600 hover:text-red-900">
                        {{ __('Delete') }}
                    </x-button>
                </td>
            </tr>
        @endforeach
    </x-slot:body>
</x-table>
