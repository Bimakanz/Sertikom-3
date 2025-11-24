<x-app-layout>
    <div class="px-4 sm:px-8 py-6">

        <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Edit Jurusan</h1>

        <div class="bg-white p-4 sm:p-6 rounded-xl border shadow-sm max-w-xl mx-auto">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('jurusan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama Jurusan</label>
                    <input
                        type="text"
                        name="nama_jurusan"
                        value="{{ old('nama_jurusan', $item->nama_jurusan) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kode Jurusan</label>
                    <input
                        type="text"
                        name="kode_jurusan"
                        value="{{ old('kode_jurusan', $item->kode_jurusan) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        required>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('jurusan.index') }}"
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