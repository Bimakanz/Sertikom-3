<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Edit Tahun Ajar</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm w-full">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('tahunajar.update', $tahunajar->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama Tahun Ajar</label>
                    <input
                        type="text"
                        name="nama_tahun_ajar"
                        value="{{ old('nama_tahun_ajar', $tahunajar->nama_tahun_ajar) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        required
                    >
                </div>

                {{-- Kode Tahun Ajar --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kode Tahun Ajar</label>
                    <input
                        type="text"
                        name="kode_tahun_ajar"
                        value="{{ old('kode_tahun_ajar', $tahunajar ->kode_tahun_ajar) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        required
                    >
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('tahunajar.index') }}"
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