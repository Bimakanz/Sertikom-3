<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Tambah Jurusan</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm max-w-xl">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf

                {{-- Nama Jurusan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama Jurusan</label>
                    <input
                        type="text"
                        name="nama_jurusan"
                        value="{{ old('nama_jurusan') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        placeholder="Contoh: Teknik Informatika"
                        required
                    >
                    @error('nama_jurusan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kode Jurusan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kode Jurusan</label>
                    <input
                        type="text"
                        name="kode_jurusan"
                        value="{{ old('kode_jurusan') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        placeholder="Contoh: TI"
                        required
                    >
                    @error('kode_jurusan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('jurusan.index') }}"
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Batal
                    </a>

                    <button
                        class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800"
                        type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>