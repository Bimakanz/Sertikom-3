<x-app-layout>
    <div class="px-4 sm:px-8 py-6 w-full">

        {{-- Judul --}}
        <h1 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Tambah User</h1>

        {{-- CARD --}}
        <div class="bg-white rounded-xl border shadow-sm p-4 sm:p-6">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-4 sm:gap-6">
                    {{-- NAMA --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama</label>
                        <input
                            type="text"
                            name="name"
                            placeholder="Masukkan nama"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-gray-300"
                            required
                        >
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="Masukkan email"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-gray-300"
                            required
                        >
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-gray-300"
                            required
                        >
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Konfirmasi password"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-gray-300"
                            required
                        >
                        @error('password_confirmation')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ROLE --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Role</label>
                        <select
                            name="role"
                            class="w-full mt-1 px-3 py-2 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-gray-300"
                            required
                        >
                            <option value="">-- Pilih Role --</option>
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4">
                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 text-center">
                        Batal
                    </a>

                    <button
                        class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-800"
                        type="submit">
                        Simpan
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>