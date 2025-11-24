<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Edit Kelas</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm max-w-xl">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Kelas --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama Kelas</label>
                    <input type="text"
                           name="nama_kelas"
                           value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                           required>
                </div>

                {{-- Level --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Level Kelas</label>
                    <input type="number"
                           name="level_kelas"
                           value="{{ old('level_kelas', $kelas->level_kelas) }}"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                           required>
                </div>

                {{-- Jurusan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Jurusan</label>
                    <select name="jurusan_id"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            required>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}" {{ $kelas->jurusan_id == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Tahun Ajar</label>
                    <select name="tahun_ajar_id"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            required>
                        @foreach ($tahunAjar as $t)
                            <option value="{{ $t->id }}" {{ $kelas->tahun_ajar_id == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_tahun_ajar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('kelas.index') }}"
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Batal
                    </a>

                    <button class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>