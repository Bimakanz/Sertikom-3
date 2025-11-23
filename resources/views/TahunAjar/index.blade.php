<x-app-layout>
    <div class="px-8 py-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Tahun Ajar</h1>

            <a href="{{ route('tahunajar.create') }}"
                class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800">
                + Tambah Tahun Ajar
            </a>
        </div>

        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <table class="w-full">
                <thead>
                    <tr class=" text-left  text-gray-600 text-sm border-b">
                        <th class="py-3">Kode Tahun Ajar</th>
                        <th class="py-3">Tahun Ajar</th>
                        <th class="py-3 px-7">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @forelse ($data as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 text-left">{{ $item->kode_tahun_ajar }}</td>
                            <td class="py-3 text-left">{{ $item->nama_tahun_ajar }}</td>
                            <td class="py-3 flex items-center gap-2">

                                {{-- EDIT BUTTON --}}
                                <a href="{{ route('tahunajar.edit', $item->id) }}"
                                    class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M16.862 4.487l1.687 1.688m-1.687-1.688l-9.193 9.193a4.5 4.5 0 00-1.118 2.003l-.53 2.121a.75.75 0 00.91.91l2.12-.53a4.5 4.5 0 002.004-1.119l9.193-9.193m-1.686-1.688l1.686 1.688" />
                                    </svg>
                                </a>

                                {{-- DELETE BUTTON --}}
                                <form action="{{ route('tahunajar.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21A48.108 48.108 0 0112 
                                6.75c-2.28 0-4.487.155-6.728.46M4.292 5.79L5 
                                19.25A2.25 2.25 0 007.24 21h9.52A2.25 2.25 0 0019 
                                19.25l.708-13.46M10 6v-.5a2 2 0 012-2h0a2 2 0 012 
                                2V6" />
                                        </svg>
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $data->links() }}
            </div>
        </div>

    </div>
</x-app-layout>