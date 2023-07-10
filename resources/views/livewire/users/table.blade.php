<x-table>
    <x-slot name="head">
        <x-table.heading>{{ __("Name") }}</x-table.heading>
        <x-table.heading>{{ __("Email") }}</x-table.heading>
        <x-table.heading>{{ __("Created") }}</x-table.heading>
        <x-table.heading>{{ __("Updated") }}</x-table.heading>
        <x-table.heading class="pr-0 text-right">{{ __("Actions") }}</x-table.heading>
    </x-slot>
    <x-slot name="body">
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format("d.m.Y H:i:s") }}</td>
                <td>{{ $user->updated_at->format("d.m.Y H:i:s") }}</td>
                <td class="flex justify-end">
                    <x-button
                        color="link"
                        :href="route('users.show', $user)"
                        class="text-blue-600 hover:text-blue-900"
                    >
                        {{ __("Show") }}
                    </x-button>
                    <x-button
                        color="link"
                        :href="route('users.edit', $user)"
                        class="text-indigo-600 hover:text-indigo-900"
                    >
                        {{ __("Edit") }}
                    </x-button>
                    <x-button
                        color="link"
                        wire:click="confirmDelete({{ $user->id }})"
                        class="text-red-600 hover:text-red-900"
                    >
                        {{ __("Delete") }}
                    </x-button>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-table>
