<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700 mb-1"/>
            <x-text-input id="name" class="block mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-gray-300 focus:border-transparent" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-1"/>
            <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-gray-300 focus:border-transparent" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-1"/>

            <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-gray-300 focus:border-transparent"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700 mb-1"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-gray-300 focus:border-transparent"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600" />
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6">
            <a class="underline text-xs sm:text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-0 sm:ms-4 w-full sm:w-auto px-4 py-2">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
