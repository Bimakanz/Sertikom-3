<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detail Siswa</h2>
    </x-slot>

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('siswa.index') }}"
            class="p-2 border rounded-lg hover:bg-gray-100 transition" title="Kembali ke daftar siswa">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Detail Siswa</h1>
    </div>

    <div class="w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Student Info Card --}}
            <div class="bg-white p-6 rounded-lg shadow">
                
                <h3 class="text-xl font-bold mb-2">{{ $siswa->nama_lengkap }}</h3>

                <div class="grid grid-cols-2 gap-y-2 text-sm">
                    <p class="text-gray-600">NISN</p>
                    <p>{{ $siswa->nisn }}</p>

                    <p class="text-gray-600">Alamat</p>
                    <p>{{ $siswa->alamat }}</p>

                    <p class="text-gray-600">Nama Siswa</p>
                    <p>{{ $siswa->nama_lengkap }}</p>

                    <p class="text-gray-600">Jenis Kelamin</p>
                    <p>{{ $siswa->jenis_kelamin }}</p>

                    <p class="text-gray-600">Tanggal Lahir</p>
                    <p>{{ ($siswa->tanggal_lahir)->format('d F Y') }}</p>


                    <p class="text-gray-600">Kelas</p>
                    <p>{{ $siswa->kelas->nama_kelas }}</p>

                    <p class="text-gray-600">Tahun Ajar</p>
                    <p>{{ $siswa->tahun_ajar->nama_tahun_ajar }}</p>
                </div>
            </div>

            {{-- Update Form Card --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">Update Kelas dan Tahun Ajar</h3>

                {{-- Success Notification --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <select name="kelas_id"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajar</label>
                        <select name="tahun_ajar_id"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            <option value="">-- Pilih Tahun Ajar --</option>
                            @foreach($tahunajar as $t)
                                <option value="{{ $t->id }}" {{ old('tahun_ajar_id', $siswa->tahun_ajar_id) == $t->id ? 'selected' : '' }}>
                                    {{ $t->nama_tahun_ajar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                        Update
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl mt-6 shadow-sm border p-4">
            <h2 class="text-xl font-bold mb-4">Riwayat Kelas</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left">
                            <th class="py-3 px-2 font-semibold text-gray-700">Kelas</th>
                            <th class="py-3 px-2 font-semibold text-gray-700">Tahun Ajar</th>
                            <th class="py-3 px-2 font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kelasDetails as $riwayat)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="py-3 px-2 font-medium">
                                    {{ $riwayat->kelas->nama_kelas }}
                                </td>

                                <td class="py-2">
                                    {{ $riwayat->tahun_ajar->kode_tahun_ajar ?? '-' }}
                                </td>

                                <td class="py-3 px-2">
                                    @if ($riwayat->status == 'Aktif')
                                        <span class="px-2 py-1 text-xs rounded-md bg-green-100 text-green-600 font-semibold">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-md bg-gray-100 text-gray-500">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 sm:mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Halaman {{ $kelasDetails->currentPage() }} dari {{ $kelasDetails->lastPage() }}
                </div>

                <div class="flex items-center space-x-2">
                    {{-- Previous Button --}}
                    @if ($kelasDetails->onFirstPage())
                        <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $kelasDetails->previousPageUrl() }}"
                            class="p-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Next Button --}}
                    @if ($kelasDetails->hasMorePages())
                        <a href="{{ $kelasDetails->nextPageUrl() }}"
                            class="p-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>