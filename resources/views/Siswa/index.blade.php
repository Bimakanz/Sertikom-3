<x-app-layout>
    <div class="px-4 py-6 sm:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <h1 class="text-2xl font-bold">Data Siswa</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <form method="GET" action="{{ route('siswa.index') }}" class="w-full sm:w-auto">
                    <div class="flex">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari siswa..." 
                            value="{{ request('search') }}"
                            class="px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-gray-300 w-full"
                        >
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-gray-800 text-white rounded-r-lg hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
                
                <a href="{{ route('siswa.create') }}"
                   class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800 w-full sm:w-auto text-center">
                    + Tambah Siswa
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl p-4 sm:p-6 border shadow-sm">

            <!-- DESKTOP TABLE -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 text-sm border-b">
                            <th class="py-3">Nama</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">Jurusan</th>
                            <th class="py-3 px-12">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @forelse ($siswa as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $item->nama_lengkap }}</td>
                                <td class="py-3">{{ $item->kelas->level_kelas ?? '-' }}</td>
                                <td class="py-3">{{ $item->jurusan->nama_jurusan ?? '-' }}</td>

                                <td class="py-3 flex items-center gap-2">

                                    {{-- DETAIL BUTTON --}}
                                    <a href="{{ route('siswa.show', $item->id) }}"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('siswa.edit', $item->id) }}"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M16.862 4.487l1.687 1.688m-1.687-1.688l-9.193 9.193a4.5 4.5 0
                                                00-1.118 2.003l-.53 2.121a.75.75 0 00.91.91l2.12-.53a4.5 4.5 0
                                                002.004-1.119l9.193-9.193m-1.686-1.688l1.686 1.688" />
                                        </svg>
                                    </a>

                                    {{-- DELETE BUTTON --}}
                                    <button
                                        onclick="showDeleteModal('{{ $item->id }}', '{{ $item->nama_lengkap }}')"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition delete-btn"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->nama_lengkap }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.998-3.21A48.108 48.108 0 0112
                                                6.75c-2.28 0-4.487.155-6.728.46M4.292 5.79L5
                                                19.25A2.25 2.25 0 007.24 21h9.52A2.25 2.25 0 0019
                                                19.25l.708-13.46M10 6v-.5a2 2 0 012-2h0a2 2 0 012
                                                2V6" />
                                        </svg>
                                    </button>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Belum ada data siswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE CARD VIEW -->
            <div class="md:hidden space-y-6">
                @forelse ($siswa as $item)
                    <div class="border rounded-lg p-4 bg-white shadow-sm">
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div>
                                <p class="text-xs text-gray-500">NISN</p>
                                <p class="font-medium">{{ $item->nisn }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nama</p>
                                <p class="font-medium">{{ $item->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Kelas</p>
                                <p class="font-medium">{{ $item->kelas->level_kelas ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Jurusan</p>
                                <p class="font-medium">{{ $item->jurusan->nama_jurusan ?? '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500">Tahun Ajar</p>
                                <p class="font-medium">{{ $item->tahun_ajar->nama_tahun_ajar ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex space-x-2 ml-2">
                                {{-- DETAIL BUTTON --}}
                                <a href="{{ route('siswa.show', $item->id) }}"
                                        class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0"
                                    title="Lihat detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                {{-- EDIT BUTTON --}}
                                <a href="{{ route('siswa.edit', $item->id) }}"
                                    class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M16.862 4.487l1.687 1.688m-1.687-1.688l-9.193 9.193a4.5 4.5 0
                                            00-1.118 2.003l-.53 2.121a.75.75 0 00.91.91l2.12-.53a4.5 4.5 0
                                            002.004-1.119l9.193-9.193m-1.686-1.688l1.686 1.688" />
                                    </svg>
                                </a>

                                {{-- DELETE BUTTON --}}
                                <button
                                    onclick="showDeleteModal('{{ $item->id }}', '{{ $item->nama_lengkap }}')"
                                    class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0 delete-btn"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->nama_lengkap }}"
                                    title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.998-3.21A48.108 48.108 0 0112
                                            6.75c-2.28 0-4.487.155-6.728.46M4.292 5.79L5
                                            19.25A2.25 2.25 0 007.24 21h9.52A2.25 2.25 0 0019
                                            19.25l.708-13.46M10 6v-.5a2 2 0 012-2h0a2 2 0 012
                                            2V6" />
                                    </svg>
                                </button>
                                </div>

                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada data siswa</p>
                @endforelse
            </div>
    <div class="mt-4 sm:mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}
                </div>
                
                <div class="flex items-center space-x-2">
                    {{-- Previous Button --}}
                    @if ($siswa->onFirstPage())
                        <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $siswa->previousPageUrl() }}" 
                           class="p-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Next Button --}}
                    @if ($siswa->hasMorePages())
                        <a href="{{ $siswa->nextPageUrl() }}" 
                           class="p-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Konfirmasi Hapus</h3>
                    <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menghapus <span id="deleteItemName" class="font-semibold"></span>?</p>

                <div class="flex justify-end space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            let deleteForm = document.getElementById('deleteForm');

            function showDeleteModal(id, name) {
                document.getElementById('deleteItemName').textContent = name;
                document.getElementById('deleteForm').action = "{{ route('siswa.destroy', ':id') }}".replace(':id', id);
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            // Close modal when clicking outside the modal
            document.getElementById('deleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteModal();
                }
            });
        </script>
    </div>
</x-app-layout>
