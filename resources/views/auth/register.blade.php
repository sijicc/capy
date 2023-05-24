<x-guest-layout :title="[['name' => __('Register')]]">
    <x-card class="h-screen sm:max-w-md sm:h-fit">
        <div class="flex items-center justify-center">
            <a href="{{ route('login') }}">
                @svg('heroicon-m-moon', 'h-16 w-16 text-indigo-600')
            </a>
        </div>
        <div class="mt-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
                {{ __('Register') }}
            </h1>
        </div>

        <x-form :action="route('register')" class="mt-6">
            <div>
                <x-forms.label for="name" :value="__('Name')" class="required"/>
                <x-forms.input name="name" required autofocus/>
                <x-forms.info>
                    {{ __('Your name will be displayed on your profile page.') }}
                </x-forms.info>
            </div>
            <div class="mt-4">
                <x-forms.label for="email" :value="__('Email address')" class="required"/>
                <x-forms.input name="email" type="email" required/>
                <x-forms.info>
                    {{ __('Your email address will be used to send you notifications.') }}
                </x-forms.info>
            </div>
            <div class="mt-4">
                <x-forms.label for="password" :value="__('Password')" class="required"/>
                <x-forms.input name="password" type="password" required autocomplete="new-password"/>
                <x-forms.info>
                    {{ __('Your password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter and one number.') }}
                </x-forms.info>
            </div>
            <div class="mt-4">
                <x-forms.label for="password" :value="__('Confirm password')" class="required"/>
                <x-forms.input name="password_confirmation" type="password" required autocomplete="new-password"/>
                <x-forms.info>
                    {{ __('Please confirm your password.') }}
                </x-forms.info>
            </div>
            <div class="mt-4">
                {{-- accept tos --}}
                <x-forms.checkbox name="tos" :label="__('I accept the Terms of Service')" required/>
            </div>
            <div class="mt-6">
                <x-button class="w-full">
                    {{ __('Register') }}
                </x-button>
            </div>
        </x-form>
    </x-card>
</x-guest-layout>
