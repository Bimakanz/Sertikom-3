<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Siswa</h2>
    </x-slot>

    <div class="p-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">

            <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- NISN --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">NISN</label>
                    <input type="text" name="nisn"
                        class="w-full border-gray-300 rounded-lg"
                        value="{{ old('nisn') }}">
                    @error('nisn') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Nama --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="nama"
                        class="w-full border-gray-300 rounded-lg"
                        value="{{ old('nama') }}">
                    @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Alamat</label>
                    <textarea name="alamat"
                        class="w-full border-gray-300 rounded-lg">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Tgl lahir --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        class="w-full border-gray-300 rounded-lg"
                        value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis kelamin --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border-gray-300 rounded-lg">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected':'' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected':'' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Jurusan --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Jurusan</label>
                    <select name="jurusan_id" class="w-full border-gray-300 rounded-lg">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}" {{ old('jurusan_id')==$j->id?'selected':'' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Kelas --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kelas</label>
                    <select name="kelas_id" class="w-full border-gray-300 rounded-lg">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id')==$k->id?'selected':'' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block font-medium mb-1">Tahun Ajar</label>
                    <select name="tahun_ajar_id" class="w-full border-gray-300 rounded-lg">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach ($tahunAjar as $t)
                            <option value="{{ $t->id }}" {{ old('tahun_ajar_id')==$t->id?'selected':'' }}>
                                {{ $t->nama_tahun_ajar }}
                            </option>
                        @endforeach
                    </select>
                    @error('tahun_ajar_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                {{-- Foto --}}
                <div class="mb-6">
                    <label class="block font-medium mb-1">Foto (optional)</label>
                    <input type="file" name="foto" class="w-full">
                    @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    Simpan
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
