<x-guest-layout :title="[['name' => __('Login')]]">
    <x-card class="h-screen sm:max-w-md sm:h-fit">
        <div class="flex items-center justify-center">
            <a href="{{ route('login') }}">
                @svg('heroicon-m-moon', 'h-16 w-16 text-indigo-600')
            </a>
        </div>
        <div class="mt-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
                {{ __('Sign in to your account') }}
            </h1>
        </div>
        <x-form :action="route('login')" class="mt-6">
            <div>
                <x-forms.label for="email" :value="__('Email address')"/>
                <x-forms.input name="email" type="email" autocomplete="email" required/>
            </div>
            <div class="mt-4">
                <x-forms.label for="password" :value="__('Password')"/>
                <x-forms.input name="password" type="password" autocomplete="current-password" required/>
            </div>
            <div class="mt-4">
                <x-forms.checkbox name="remember" :label="__('Remember me')"/>
            </div>
            <div class="mt-6">
                <x-button class="w-full">
                    <x-slot:prependIcon>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                @svg('heroicon-s-lock-closed', 'h-5 w-5 text-indigo-500 group-hover:text-indigo-400')
                            </span>
                    </x-slot:prependIcon>
                    {{ __('Sign in') }}
                </x-button>
                <div class="mt-6">
                    <p class="text-sm text-gray-600">
                        {{ __('Don\'t have an account?') }}
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('Sign up') }}
                        </a>
                    </p>
                </div>
            </div>
        </x-form>
    </x-card>

</x-guest-layout>
