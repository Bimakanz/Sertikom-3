<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Tambah Tahun Ajar</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm max-w-full">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('tahunajar.store') }}" method="POST">
                @csrf

                {{-- Nama Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama Tahun Ajar</label>
                    <input
                        type="text"
                        name="nama_tahun_ajar"
                        value="{{ old('nama_tahun_ajar') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        placeholder="Contoh: 2024/2025"
                        required
                    >
                    @error('nama_tahun_ajar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kode Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kode Tahun Ajar</label>
                    <input
                        type="text"
                        name="kode_tahun_ajar"
                        value="{{ old('kode_tahun_ajar') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        placeholder="Contoh: SemesterGanjil-2425"
                        required
                    >
                    @error('kode_tahun_ajar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Tombol --}}
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('tahunajar.index') }}"
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