<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Tambah Kelas</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm w-full">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                {{-- Nama Kelas --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama Kelas</label>
                    <input type="text" name="nama_kelas"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                           required>
                </div>

                {{-- Level Kelas --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Level Kelas</label>
                    <input type="number" min="1" max="12" name="level_kelas"
                           class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                           required>
                </div>

                {{-- Jurusan --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Jurusan</label>
                    <select name="jurusan_id"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
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
                        Simpan
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>