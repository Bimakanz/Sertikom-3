<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detail Siswa</h2>
    </x-slot>

    <div class="p-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">

            <div class="flex gap-8">
                
                {{-- Foto --}}
                <div>
                    @if ($siswa->foto)
                        <img src="{{ asset('storage/'.$siswa->foto) }}" class="w-40 rounded-lg shadow">
                    @else
                        <div class="w-40 h-40 flex items-center justify-center bg-gray-200 rounded-lg">
                            <p class="text-gray-500">Tidak ada foto</p>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1">
                    <h3 class="text-xl font-bold mb-2">{{ $siswa->nama }}</h3>

                    <div class="grid grid-cols-2 gap-y-2 text-sm">
                        <p class="text-gray-600">NISN</p>
                        <p>{{ $siswa->nisn }}</p>

                        <p class="text-gray-600">Alamat</p>
                        <p>{{ $siswa->alamat }}</p>

                        <p class="text-gray-600">Jenis Kelamin</p>
                        <p>{{ $siswa->jenis_kelamin }}</p>

                        <p class="text-gray-600">Tanggal Lahir</p>
                        <p>{{ $siswa->tanggal_lahir }}</p>

                        <p class="text-gray-600">Jurusan</p>
                        <p>{{ $siswa->jurusan->nama_jurusan }}</p>

                        <p class="text-gray-600">Kelas</p>
                        <p>{{ $siswa->kelas->nama_kelas }}</p>

                        <p class="text-gray-600">Tahun Ajar</p>
                        <p>{{ $siswa->tahunAjar->nama_tahun_ajar }}</p>
                    </div>
                </div>
            </div>

            {{-- Riwayat kelas --}}
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Riwayat Kelas</h3>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-3 py-2">Kelas</th>
                            <th class="border px-3 py-2">Tahun Ajar</th>
                            <th class="border px-3 py-2">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswa->kelasDetail as $riwayat)
                            <tr>
                                <td class="border px-3 py-2">{{ $riwayat->kelas->nama_kelas }}</td>
                                <td class="border px-3 py-2">{{ $riwayat->tahunAjar->nama_tahun_ajar }}</td>
                                <td class="border px-3 py-2">
                                    <span class="{{ $riwayat->status=='aktif' ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ $riwayat->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
