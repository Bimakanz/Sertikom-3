<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detail Siswa</h2>
    </x-slot>

    <h1 class="text-2xl font-bold mb-6">Detail Siswa</h1>

    <div class="p-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">

            <div class="flex gap-8">

                {{-- Info --}}
                <div class="flex-1">
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
                        <p>{{ $siswa->tanggal_lahir }}</p>

                        <p class="text-gray-600">Kelas</p>
                        <p>{{ $siswa->kelas->nama_kelas }}</p>

                        <p class="text-gray-600">Tahun Ajar</p>
                        <p>{{ $siswa->tahun_ajar->nama_tahun_ajar }}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-xl mt-10 shadow-sm border p-4">
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
                        @foreach ($siswa->kelas_details as $riwayat)
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

        </div>

        </table>

    </div>
</x-app-layout>