<div x-data="{ open: false, showLogoutModal: false }" class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:z-auto">

        <!-- Logo and Close Button -->
        <div class="px-6 py-6 border-b border-gray-200 flex justify-between items-center">
            <div class="text-2xl font-semibold text-gray-800 leading-tight">
                Sistem Pendataan Siswa
            </div>
            <!-- Close button for mobile -->
            <button @click="open = false" class="lg:hidden text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Menu -->
        <nav class="py-6 space-y-1 ">

            <!-- Dashboard: semua role -->
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
                {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white shadow-sm' : 'text-black hover:bg-gray-100 hover:text-black' }}">
                <svg class="pt-2" width="40px" height="40px" viewBox="0 -0.5 25 25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="pt-2 font-bold">Dashboard</span>
            </x-nav-link>

            <!-- Menu guru & admin -->
            @php
                $user = auth()->user();
                $userRole = $user ? $user->role : null;
            @endphp
            @if(in_array($userRole, ['admin', 'guru']))
                <x-nav-link :href="route('siswa.index')" :active="request()->routeIs('siswa.index')"
                    class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
                        {{ request()->routeIs('siswa.index') ? 'bg-gray-900 text-white shadow-sm' : 'text-black hover:bg-gray-100 hover:text-black' }}">
                    <!-- SVG Siswa -->
                    <svg width="40px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="2" stroke="currentColor" stroke-width="1.5" />
                        <path
                            d="M13 15C13 16.1046 13 17 9 17C5 17 5 16.1046 5 15C5 13.8954 6.79086 13 9 13C11.2091 13 13 13.8954 13 15Z"
                            stroke="currentColor" stroke-width="1.5" />
                        <path
                            d="M22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C21.298 5.64118 21.5794 6.2255 21.748 7"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M19 12H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M19 9H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M19 15H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="pt-2 px-5 font-bold">Siswa</span>
                </x-nav-link>

                <x-nav-link :href="route('tahunajar.index')" :active="request()->routeIs('tahunajar.*')"
                    class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
                        {{ request()->routeIs('tahunajar.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-black hover:bg-gray-100 hover:text-black' }}">
                    <!-- SVG Tahun Ajar -->
                    <svg width="45px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <rect x="6" y="12" width="3" height="3" rx="0.5" fill="currentColor" />
                        <rect x="10.5" y="12" width="3" height="3" rx="0.5" fill="currentColor" />
                        <rect x="15" y="12" width="3" height="3" rx="0.5" fill="currentColor" />
                    </svg>
                    <span class="pt-2 font-bold">Tahun Ajar</span>
                </x-nav-link>

                <x-nav-link :href="route('jurusan.index')" :active="request()->routeIs('jurusan.*')"
                    class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
                        {{ request()->routeIs('jurusan.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-black hover:bg-gray-100 hover:text-black' }}">
                    <!-- SVG Jurusan -->
                    <svg width="50px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 9L12 4L2 9L12 14L22 9ZM22 9V15M19 10.5V16.5L12 20L5 16.5V10.5" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="pt-2 px-2 font-bold">Jurusan</span>
                </x-nav-link>

                <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')"
                    class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
                        {{ request()->routeIs('kelas.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-black hover:bg-gray-100 hover:text-black' }}">
                    <!-- SVG Kelas -->
                    <svg fill="currentColor" width="45px" height="30px" viewBox="0 0 32 32" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M30 20.75h-5.75v-7.596l5.129 2.931c0.178 0.104 0.393 0.165 0.621 0.165 0.69 0 1.25-0.56 1.25-1.25 0-0.462-0.251-0.865-0.623-1.082l-0.006-0.003-12.932-7.389c0.373-0.014 0.728-0.064 1.070-0.148l-0.036 0.007c0.291-0.057 0.626-0.089 0.969-0.089 0.363 0 0.717 0.036 1.059 0.106l-0.034-0.006c0.061 0.011 0.131 0.017 0.203 0.017 0.69 0 1.25-0.56 1.25-1.25v0-2.812c0-0 0-0 0-0 0-0.592-0.412-1.088-0.964-1.217l-0.008-0.002c-0.453-0.117-0.973-0.185-1.509-0.185-0.541 0-1.067 0.069-1.568 0.198l0.043-0.010c-0.254 0.059-0.546 0.093-0.845 0.093-0.13 0-0.259-0.006-0.386-0.019l0.016 0.001c-0.225-0.28-0.566-0.459-0.948-0.463h-0.001c-0.69 0-1.25 0.56-1.25 1.25v0 4.275l-13.37 7.64c-0.379 0.219-0.63 0.623-0.63 1.085 0 0.69 0.56 1.25 1.25 1.25 0.228 0 0.442-0.061 0.626-0.168l-0.006 0.003 5.13-2.931v7.596h-5.75c-0.69 0-1.25 0.56-1.25 1.25v8c0 0.69 0.56 1.25 1.25 1.25h28c0.69-0.001 1.249-0.56 1.25-1.25v-8c-0.001-0.69-0.56-1.249-1.25-1.25h-0zM18.791 3.557c0.246-0.069 0.528-0.109 0.819-0.109 0.021 0 0.042 0 0.063 0.001l-0.003-0v0.352c-0.555 0.010-1.090 0.068-1.608 0.171l0.058-0.009c-0.258 0.076-0.554 0.119-0.86 0.119-0.001 0-0.002 0-0.003 0h-0.007v-0.336c0.547-0 1.078-0.069 1.586-0.197l-0.045 0.010zM3.25 23.25h4.5v5.5h-4.5zM10.25 22v-10.275l5.75-3.286 5.75 3.286v17.025h-1.5v-4.75c-0.001-0.69-0.56-1.249-1.25-1.25h-6c-0.69 0-1.25 0.56-1.25 1.25v4.75h-1.5zM14.25 28.75v-3.5h3.5v3.5zM28.75 28.75h-4.5v-5.5h4.5zM16 20.25c2.347 0 4.25-1.903 4.25-4.25s-1.903-4.25-4.25-4.25c-2.347 0-4.25 1.903-4.25 4.25v0c0.002 2.346 1.904 4.247 4.25 4.25h0zM16 14.25c0.966 0 1.75 0.784 1.75 1.75s-0.784 1.75-1.75 1.75c-0.966 0-1.75-0.784-1.75-1.75v0c0.001-0.966 0.784-1.749 1.75-1.75h0z">
                        </path>
                    </svg>
                    <span class="pt-2 px-[19px] font-bold">Kelas</span>
                </x-nav-link>
            @endif

            <!-- User Management: admin only -->
            @if($userRole === 'admin')
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                    class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
                        {{ request()->routeIs('users.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-black hover:bg-gray-100 hover:text-black' }}">
                    <!-- SVG Kelas -->
                    <svg width="40px" height="35px" viewBox="0 0 16.00 16.00" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                fill="currentColor"></path>
                            <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="currentColor">
                            </path>
                        </g>
                    </svg>
                    <span class="pt-2 px-[19px] font-bold">Users</span>
                </x-nav-link>
            @endif

        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex flex-col flex-1">
        <header class="w-full bg-white border-b border-gray-200 h-16 flex items-center px-6">
            <div class="flex items-center gap-4">
                <!-- Hamburger menu button for mobile -->
                <button @click="open = !open" class="lg:hidden text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="text-lg font-semibold text-gray-800">
                    Sistem Pendataan Siswa
                </div>
            </div>

            <div class="ml-auto flex items-center gap-4">
                @php
                    $user = auth()->user();
                    $userName = $user ? $user->name : 'User';
                    $userRole = $user ? ($user->role ?? 'guest') : 'guest';
                @endphp
                
                <div class="hidden md:block">
                    <span class="text-gray-700 font-medium">{{ $userName }}</span>
                    <div class="text-xs text-gray-500 capitalize">{{ $userRole }}</div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-gray-100 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div
                                class="relative w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-semibold border-2 border-gray-300">
                                {{ $user ? substr($user->name, 0, 1) : 'U' }}
                                <span
                                    class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></span>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </x-dropdown-link>
                        <x-dropdown-link @click.prevent="showLogoutModal = true"
                            class="cursor-pointer flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <main class="p-6">
            {{ $slot }}
        </main>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" @click="showLogoutModal = false"
        class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center" x-cloak>
        <div @click.outside="showLogoutModal = false"
            class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 border shadow-lg">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Konfirmasi Logout</h3>
                <p class="text-gray-600 mt-2">Apakah Anda yakin ingin keluar dari sistem?</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <div class="flex justify-center gap-3">
                    <button type="button" @click="showLogoutModal = false"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Keluar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>