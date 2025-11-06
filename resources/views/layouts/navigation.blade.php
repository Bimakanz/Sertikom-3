<div x-data="{ open: false }" class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">

        <!-- Logo -->
        <div class="px-6 py-6 border-b border-gray-200">
            <div class="text-2xl font-semibold text-gray-800 leading-tight">
                Sistem Pendataan Siswa
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="px-[5px] py-6 space-y-1 ">

            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
    class="flex items-center pt-3 gap-3 px-[50px] py-5 rounded-lg transition
        focus:outline-none focus:ring-0 focus:border-transparent
        {{ request()->routeIs('dashboard')
            ? 'bg-gray-900 text-white'
            : 'text-gray-700 hover:bg-gray-200' }}">

    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 9.75l9-6 9 6M4.5 10.5v9.75A1.5 1.5 0 006 21.75h12a1.5 1.5 0 001.5-1.5v-9.75" />
    </svg>

    <span class="text-2xl font-bold pt-1">Dashboard</span>
</x-nav-link>





            {{-- <x-nav-link :href="route('tahun-ajar.index')" :active="request()->routeIs('tahun-ajar.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Tahun Ajar</span>
            </x-nav-link> --}}

            {{-- <x-nav-link :href="route('jurusan.index')" :active="request()->routeIs('jurusan.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Jurusan</span>
            </x-nav-link> --}}

            {{-- <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Kelas</span>
            </x-nav-link> --}}
            {{--
            <x-nav-link :href="route('siswa.index')" :active="request()->routeIs('siswa.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Siswa</span>
            </x-nav-link> --}}
            {{--
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>User Management</span>
            </x-nav-link> --}}

        </nav>

        <!-- User footer -->
    </aside>

    <!-- Main content -->
    <div class="flex flex-col flex-1">

        <!-- Top navbar -->
        <header class="w-full bg-white border-b border-gray-200 h-16 flex items-center px-6">
            <div class="flex items-center gap-4">
                <!-- Mobile toggle -->
                <button @click="open = true" class="lg:hidden text-gray-600">
                </button>

                <div class="text-lg font-semibold text-gray-800">
                    Sistem Pendataan Siswa
                </div>
            </div>

            <div class="ml-auto flex items-center gap-3">
                <span class="text-gray-600 text-sm">{{ Auth::user()->name }}</span>

                <x-dropdown align="right">
                    <x-slot name="trigger">
                        <button class="w-9 h-9 bg-gray-200 rounded-xl border border-gray-300"></button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <!-- Page content -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</div>
