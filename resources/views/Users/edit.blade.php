<x-app-layout>
    <div class="px-8 py-6">

        <h1 class="text-2xl font-bold mb-6">Edit User</h1>

        <div class="bg-white p-6 rounded-xl border shadow-sm max-w-xl">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-4">
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
                <div class="mb-4">
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
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Role</label>
                    <select
                        name="role"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        required
                    >
                        <option value="">-- Pilih Role --</option>
                        <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                    </select>
                    @error('role')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
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
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-200"
                        placeholder="Konfirmasi password baru"
                    >
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('users.index') }}"
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
