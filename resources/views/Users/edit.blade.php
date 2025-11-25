<x-app-layout>
    <div class="px-4 sm:px-8 py-6">

        <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Edit User</h1>

        <div class="bg-white p-4 sm:p-6 rounded-xl border shadow-sm w-full">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 sm:gap-6">
                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            required
                        >
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            required
                        >
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Role</label>
                        <select
                            name="role"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            required
                        >
                            <option value="">-- Pilih Role --</option>
                            <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Password (Kosongkan jika tidak ingin diubah)</label>
                        <input
                            type="password"
                            name="password"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            placeholder="Masukkan password baru (opsional)"
                        >
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                            placeholder="Konfirmasi password baru"
                        >
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 mt-6">
                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 text-center">
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