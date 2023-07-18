<x-auth-layout>
    <x-card class="h-screen">
        <x-slot name="header">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                {{ __("Dashboard") }}
            </h3>
        </x-slot>
        <p class="text-gray-500">{{ __("You are logged in!") }}</p>
    </x-card>
</x-auth-layout>
