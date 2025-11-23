<x-app-layout>
    <div class="px-8 py-6">
        <h1 class="text-2xl font-bold mb-6">Edit Siswa</h1>

        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NISN --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    @error('nisn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Nama Lengkap --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Alamat</label>
                    <textarea name="alamat" rows="3"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Kelas --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Kelas</label>
                    <select name="kelas_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                {{-- Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Tahun Ajar</label>
                    <select name="tahun_ajar_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <option value="">-- Pilih Tahun Ajar --</option>
                        @foreach($tahunajar as $t)
                            <option value="{{ $t->id }}" {{ old('tahun_ajar_id', $siswa->tahun_ajar_id) == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_tahun_ajar }}
                            </option>
                        @endforeach
                    </select>
                    @error('tahun_ajar_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('siswa.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">Update</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
