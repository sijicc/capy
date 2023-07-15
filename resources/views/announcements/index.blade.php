<x-auth-layout :title="[['name' => __('Announcements'), 'route' => route('announcements.index')]]">
    <x-card class="min-h-screen">
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ __("Announcement") }}
                    </h3>
                    <div class="mt-1 max-w-2xl text-sm text-gray-500">
                        <p>
                            {{ __("Here you can manage your announcements.") }}
                        </p>
                    </div>
                </div>

                <div>
                    <x-button :href="route('announcements.create')">
                        {{ __("Create") }}
                    </x-button>
                </div>
            </div>
        </x-slot>
        <livewire:announcements.table />
    </x-card>
</x-auth-layout>
