<x-app-layout>
    <div class="px-4 py-6 sm:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <h1 class="text-2xl font-bold">Data Siswa</h1>

            <a href="{{ route('siswa.create') }}"
               class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800 w-full sm:w-auto text-center">
                + Tambah Siswa
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl p-4 sm:p-6 border shadow-sm">

            <!-- DESKTOP TABLE -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 text-sm border-b">
                            <th class="py-3">NISN</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">Jurusan</th>
                            <th class="py-3">Tahun Ajar</th>
                            <th class="py-3 px-7">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @forelse ($siswa as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $item->nisn }}</td>
                                <td class="py-3">{{ $item->nama_lengkap }}</td>
                                <td class="py-3">{{ $item->kelas->level_kelas ?? '-' }}</td>
                                <td class="py-3">{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                                <td class="py-3">{{ $item->tahun_ajar->nama_tahun_ajar ?? '-' }}</td>

                                <td class="py-3 flex items-center gap-2">

                                    {{-- DETAIL BUTTON --}}
                                    <a href="{{ route('siswa.show', $item->id) }}"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('siswa.edit', $item->id) }}"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M16.862 4.487l1.687 1.688m-1.687-1.688l-9.193 9.193a4.5 4.5 0
                                                00-1.118 2.003l-.53 2.121a.75.75 0 00.91.91l2.12-.53a4.5 4.5 0
                                                002.004-1.119l9.193-9.193m-1.686-1.688l1.686 1.688" />
                                        </svg>
                                    </a>

                                    {{-- DELETE BUTTON --}}
                                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.998-3.21A48.108 48.108 0 0112
                                                    6.75c-2.28 0-4.487.155-6.728.46M4.292 5.79L5
                                                    19.25A2.25 2.25 0 007.24 21h9.52A2.25 2.25 0 0019
                                                    19.25l.708-13.46M10 6v-.5a2 2 0 012-2h0a2 2 0 012
                                                    2V6" />
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Belum ada data siswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE CARD VIEW -->
            <div class="md:hidden space-y-6">
                @forelse ($siswa as $item)
                    <div class="border rounded-lg p-4 bg-white shadow-sm">
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div>
                                <p class="text-xs text-gray-500">NISN</p>
                                <p class="font-medium">{{ $item->nisn }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nama</p>
                                <p class="font-medium">{{ $item->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Kelas</p>
                                <p class="font-medium">{{ $item->kelas->level_kelas ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Jurusan</p>
                                <p class="font-medium">{{ $item->jurusan->nama_jurusan ?? '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500">Tahun Ajar</p>
                                <p class="font-medium">{{ $item->tahun_ajar->nama_tahun_ajar ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex space-x-2 ml-2">
                                {{-- DETAIL BUTTON --}}
                                <a href="{{ route('siswa.show', $item->id) }}"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0"
                                    title="Lihat detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                {{-- EDIT BUTTON --}}
                                <a href="{{ route('siswa.edit', $item->id) }}"
                                    class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M16.862 4.487l1.687 1.688m-1.687-1.688l-9.193 9.193a4.5 4.5 0
                                            00-1.118 2.003l-.53 2.121a.75.75 0 00.91.91l2.12-.53a4.5 4.5 0
                                            002.004-1.119l9.193-9.193m-1.686-1.688l1.686 1.688" />
                                    </svg>
                                </a>

                                {{-- DELETE BUTTON --}}
                                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0"
                                        title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.998-3.21A48.108 48.108 0 0112
                                                6.75c-2.28 0-4.487.155-6.728.46M4.292 5.79L5
                                                19.25A2.25 2.25 0 007.24 21h9.52A2.25 2.25 0 0019
                                                19.25l.708-13.46M10 6v-.5a2 2 0 012-2h0a2 2 0 012
                                                2V6" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada data siswa</p>
                @endforelse
            </div>

        </div>

        <div class="mt-6">
            {{ $siswa->links() }}
        </div>
    </div>
</x-app-layout>
