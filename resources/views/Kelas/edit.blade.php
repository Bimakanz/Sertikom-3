<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Edit Kelas</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm max-w-xl">
            <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="text-sm font-medium">Nama Kelas</label>
                    <input type="text" name="nama_kelas" value="{{ $item->nama_kelas }}"
                           class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-medium">Level Kelas</label>
                    <input type="number" name="level_kelas" value="{{ $item->level_kelas }}"
                           class="w-full border rounded-lg px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-medium">Jurusan</label>
                    <select name="jurusan_id" class="w-full border rounded-lg px-3 py-2">
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->id }}" 
                                {{ $item->jurusan_id == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('kelas.index') }}" class="px-4 py-2 border rounded-lg">Batal</a>
                    <button class="px-4 py-2 bg-gray-900 text-white rounded-lg">Simpan Perubahan</button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
