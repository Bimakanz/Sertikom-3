<x-app-layout>
    <div class="px-8 py-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <h1 class="text-2xl font-bold">User Management</h1>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <form method="GET" action="{{ route('users.index') }}" class="w-full sm:w-auto">
                    <div class="flex">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari user..." 
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
                
                <a href="{{ route('users.create') }}"
                    class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800 w-full sm:w-auto text-center">
                    + Tambah User
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl p-4 sm:p-6 border shadow-sm">
            <!-- DESKTOP TABLE -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 text-sm border-b">
                            <th class="py-3">Nama</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Role</th>
                            <th class="py-3 px-7">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @forelse ($users as $index => $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $user->name }}</td>
                                <td class="py-3">{{ $user->email }}</td>
                                <td class="py-3">{{ ucfirst($user->role) }}</td>
                                <td class="py-3 flex items-center gap-2">

                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('users.edit', $user) }}"
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
                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="p-2 border rounded-lg hover:bg-gray-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21A48.108 48.108 0 0112
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
                            <td colspan="5" class="py-4 text-center text-gray-500">Belum ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            <!-- MOBILE CARD VIEW -->
            <div class="md:hidden space-y-4">
                @forelse ($users as $index => $user)
                    <div class="border rounded-lg p-4 bg-white shadow-sm">
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div>
                                <p class="text-xs text-gray-500">Nama</p>
                                <p class="font-medium">{{ $user->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="font-medium">{{ $user->email }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500">Role</p>
                                <p class="font-medium">{{ ucfirst($user->role) }}</p>
                            </div>
                        </div>

                        <div class="flex justify-center space-x-2">
                            {{-- EDIT BUTTON --}}
                            <a href="{{ route('users.edit', $user) }}"
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
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus?')" class="inline">
                                @csrf
                                @method('DELETE')

                                <button class="p-2 border rounded-lg hover:bg-gray-100 transition flex-shrink-0"
                                    title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21A48.108 48.108 0 0112
                                    6.75c-2.28 0-4.487.155-6.728.46M4.292 5.79L5
                                    19.25A2.25 2.25 0 007.24 21h9.52A2.25 2.25 0 0019
                                    19.25l.708-13.46M10 6v-.5a2 2 0 012-2h0a2 2 0 012
                                    2V6" />
                            </svg>
                            </button>
                        </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Belum ada data user</p>
                @endforelse
            </div>

           <div class="mt-4 sm:mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
                </div>
                
                <div class="flex items-center space-x-2">
                    {{-- Previous Button --}}
                    @if ($users->onFirstPage())
                        <span class="p-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" 
                           class="p-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Next Button --}}
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" 
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

    </div>
</x-app-layout>
