<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("View your account's profile information and email address.") }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <div class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-md shadow-sm">
                {{ $user->name }}
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <div class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-md shadow-sm">
                {{ $user->email }}
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</section>
