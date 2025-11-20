<x-app-layout>
    <div class="px-8 py-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Kelas</h1>

            <a href="{{ route('kelas.create') }}"
               class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800">
                + Tambah Kelas
            </a>
        </div>

        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-600 text-sm border-b">
                        <th class="py-3">Nama Kelas</th>
                        <th class="py-3">Level</th>
                        <th class="py-3">Jurusan</th>
                        <th class="py-3">Tahun Ajar</th>
                        <th class="py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @forelse ($data as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">{{ $item->nama_kelas }}</td>
                            <td class="py-3 pl-4">{{ $item->level_kelas }}</td>
                            <td class="py-3">{{ $item->jurusan->nama_jurusan }}</td>
                            <td class="py-3">{{ $item->tahunAjar->nama_tahun_ajar }}</td>

                            <td class="py-3 flex gap-3">
                                <a href="{{ route('kelas.edit', $item->id) }}" class="text-blue-600">
                                    ✏️
                                </a>

                                <form action="{{ route('kelas.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('hapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
