<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mt-8 bg-white rounded-xl p-6 border shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            @if(auth()->user()->role === 'admin')
                Selamat Datang, Administrator!
            @elseif(auth()->user()->role === 'guru')
                Selamat Datang, Guru!
            @else
                Selamat Datang, Siswa!
            @endif
        </h2>
        <p class="text-gray-600">
            @if(auth()->user()->role === 'admin')
                Anda adalah Administrator Sistem Pendataan Siswa. Gunakan menu di samping kiri untuk mengelola data siswa,
                jurusan, kelas, tahun ajar, serta pengguna sistem. Anda memiliki akses penuh ke semua fitur.
            @elseif(auth()->user()->role === 'guru')
                Anda adalah Guru. Gunakan menu di samping kiri untuk mengelola data siswa, jurusan, kelas, dan tahun ajar.
                Anda dapat mengakses dan mengelola data-data terkait pendidikan sesuai dengan kewenangan Anda.
            @else
                Anda adalah Siswa. Di halaman ini, Anda dapat melihat informasi data diri Anda. Gunakan menu di samping kiri
                untuk mengakses profil dan informasi lainnya yang tersedia untuk Anda.
            @endif
        </p>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ auth()->user()->role === 'admin' ? '4' : '3' }} gap-6 justify-items-center">

                <!-- Total Siswa Card -->
                <div class="w-full max-w-sm bg-white rounded-xl p-6 border shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-600">Total Siswa</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $siswaCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Jurusan Card -->
                <div class="w-full max-w-sm bg-white rounded-xl p-6 border shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-600">Total Jurusan</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $jurusanCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Kelas Card -->
                <div class="w-full max-w-sm bg-white rounded-xl p-6 border shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-white-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-600">Total Kelas</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ $kelasCount ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total User Card - Only for Admin -->
                @if(auth()->user()->role === 'admin')
                    <div class="w-full max-w-sm bg-white rounded-xl p-6 border shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-white-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-600">Total User</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $userCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

                <div class="mt-8 bg-white border rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                        <span class="text-sm text-gray-500">{{ $recentActivities->count() }} aktivitas terbaru</span>
                    </div>
                    <div class="space-y-4">
                        @forelse($recentActivities as $act)
                            <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $act->title ?? $act->description }}</p>
                                    @if(isset($act->target) && !empty($act->target))
                                        <p class="text-sm text-gray-700 mt-1"><span class="font-medium">Target:</span> {{ $act->target }}</p>
                                    @endif
                                    @if(isset($act->subtitle))
                                        <p class="text-xs text-gray-500 mt-1">{{ $act->subtitle }}</p>
                                    @endif
                                    <div class="flex items-center mt-2">
                                        <span class="text-xs text-gray-400">{{ $act->created_at->format('d M Y H:i') }}</span>
                                        <span class="mx-2 text-xs text-gray-300">•</span>
                                        <span class="text-xs text-gray-400">{{ $act->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="mt-2 text-gray-500">Belum ada aktivitas terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>



        </div>
    </div>
</x-app-layout>