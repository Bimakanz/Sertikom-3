<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - Sistem Pendataan Siswa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex items-center justify-center">
            <div class="w-full max-w-md p-6 sm:p-8 bg-white rounded-xl shadow-sm">
                <div class="text-center mb-6 sm:mb-8">
                    <h1 class="text-xl sm:text-3xl font-bold text-gray-800">Sistem Pendataan Siswa</h1>
                    <p class="text-sm sm:text-base text-gray-600 mt-2">Silakan masuk untuk melanjutkan</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-4 text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-transparent"
                               placeholder="Masukkan email Anda">
                        @error('email')
                            <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               class="w-full px-3 py-2 sm:px-4 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-300 focus:border-transparent"
                               placeholder="Masukkan password">
                        @error('password')
                            <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-6">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="h-4 w-4 text-gray-600 rounded border-gray-300 focus:ring-gray-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900 text-center sm:text-right" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                            class="w-full py-2 sm:py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Masuk
                    </button>
                </form>

                <div class="mt-4 sm:mt-6 text-center">
                    <p class="text-gray-600 text-xs sm:text-sm">
                        Belum punya akun? <span class="text-gray-600 font-medium">Hubungi administrator untuk mendaftar.</span>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
