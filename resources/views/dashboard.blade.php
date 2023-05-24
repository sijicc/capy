<x-auth-layout :title="[['name' => __('Dashboard'), 'route' => route('dashboard')]]">
    <x-card class="h-screen">
        <x-slot:header>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('Dashboard') }}
            </h3>
        </x-slot:header>
        <p class="text-gray-500">{{ __('You are logged in!') }}</p>
    </x-card>
</x-auth-layout>
