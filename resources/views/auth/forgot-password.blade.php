<x-guest-layout>
    <div class="mb-4 text-xs sm:text-sm text-gray-600 text-center">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-1"/>
            <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-gray-300 focus:border-transparent" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <div class="flex justify-center mt-4">
            <x-primary-button class="px-4 py-2">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
