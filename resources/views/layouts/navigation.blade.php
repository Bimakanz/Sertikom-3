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
        <nav class="py-6 space-y-1 ">

            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="gap-3 px-10 mx-4 pb-2 rounded-lg font-semibold transition-all duration-200
        {{ request()->routeIs('dashboard')
    ? 'bg-gray-900 text-white shadow-sm'
    : 'text-black hover:bg-gray-100 hover:text-black' }}">
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

            <x-nav-link :href="route('siswa.index')" :active="request()->routeIs('siswa.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Siswa</span>
            </x-nav-link>

            <x-nav-link :href="route('tahunajar.index')" :active="request()->routeIs('tahunajar.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Tahun Ajar</span>
            </x-nav-link>
            <x-nav-link :href="route('jurusan.index')" :active="request()->routeIs('jurusan.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Jurusan</span>
            </x-nav-link>
            <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')"
                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-200 transition">
                <span>Kelas</span>
            </x-nav-link>


            {{--  --}}

            {{--  --}}

            {{--  --}}
            {{--

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