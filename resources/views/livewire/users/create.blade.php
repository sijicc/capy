<x-card class="min-h-screen" footer-class="flex justify-end">
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __("Create User") }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __("Here you can create a new user.") }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <form method="post" wire:submit.prevent="store">
        @csrf
        <div>
            <div class="my-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __("User") }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __("Here you can add user details.") }}
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <x-forms.label for="name" class="required" :value="__('Name')" />
                <x-forms.input name="name" type="text" wire:model.defer="user.name" required />
            </div>

            <div class="mb-6">
                <x-forms.label for="email" class="required" :value="__('Email address')" />
                <x-forms.input name="email" type="email" wire:model.defer="user.email" required />
            </div>

            <div class="mb-6">
                <x-forms.label for="password" class="required" :value="__('Password')" />
                <div class="relative">
                    <x-forms.input name="password" type="password" wire:model.defer="user.password" required />
                    @svg('heroicon-s-eye', 'h-6 w-6 absolute right-0 top-0 mt-2 mr-2 cursor-pointer text-gray-400', ['x-on:click' => 'document.getElementById("password").type = document.getElementById("password").type === "password" ? "text" : "password"'])
                </div>

                <x-button type="button" class="mt-2" wire:click="generateSafePassword">
                    {{ __("Generate safe password") }}
                </x-button>
            </div>
        </div>

        <div>
            <x-button color="danger" :href="route('users.index')" class="mr-3">
                {{ __("Cancel") }}
            </x-button>
            <x-button color="submit">
                {{ __("Create") }}
            </x-button>
        </div>
    </form>
</x-card>
