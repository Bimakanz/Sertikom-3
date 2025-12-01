<x-app-layout>
    <div class="px-8 py-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Siswa</h1>

        <div class="w-full">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Student Info Card --}}
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-xl font-bold mb-4">Informasi Siswa</h3>

                        <div class="space-y-4">
                            {{-- NISN --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                                <input type="number" name="nisn" value="{{ old('nisn') }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                @error('nisn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_kelamin" value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' }} class="mr-2">
                                        Laki-Laki
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} class="mr-2">
                                        Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Alamat --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">{{ old('alamat') }}</textarea>
                                @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Class Information Card --}}
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-xl font-bold mb-4">Informasi Kelas</h3>

                        <div class="space-y-4">
                            {{-- Kelas --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                <select name="kelas_id"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Jurusan --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                                <select name="jurusan_id"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                                            {{ $j->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jurusan_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            {{-- Tahun Ajar --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajar</label>
                                <select name="tahun_ajar_id"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    <option value="">-- Pilih Tahun Ajar --</option>
                                    @foreach($tahunajar as $t)
                                        <option value="{{ $t->id }}" {{ old('tahun_ajar_id') == $t->id ? 'selected' : '' }}>
                                            {{ $t->nama_tahun_ajar }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tahun_ajar_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        
                            {{-- Submit Button --}}
                            <div class="pt-4">
                                <button type="submit" class="w-full px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                                    Simpan
                                </button>
                                <a href="{{ route('siswa.index') }}" class="block mt-2 w-full px-4 py-2 border text-center rounded-lg hover:bg-gray-100">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>