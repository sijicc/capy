<x-auth-layout :title="[['name' => __('Users'), 'route' => route('users.index')]]">
    <x-card class="h-screen">
        <x-slot:header>
            <div class="flex justify-between">

                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('Users') }}
                    </h3>
                    <div class="mt-1 max-w-2xl text-sm text-gray-500">
                        <p>
                            {{ __('Here you can manage your users.') }}
                        </p>
                    </div>
                </div>

                <div>
                    <x-button :href="route('users.create')">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </div>
        </x-slot:header>
        <livewire:users.table/>
    </x-card>
</x-auth-layout>
