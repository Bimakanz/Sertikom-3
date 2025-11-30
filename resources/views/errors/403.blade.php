<x-app-layout>
    <div class="min-h-[80vh] flex flex-col items-center justify-center text-center px-6">
        
        <div class="max-w-lg">
            <h1 class="text-6xl font-extrabold text-gray-900 mb-4 tracking-tight">
                403
            </h1>

            <h2 class="text-2xl font-semibold text-gray-800 mb-3">
                Akses Ditolak
            </h2>

            <p class="text-gray-600 text-base leading-relaxed mb-8">
                Anda tidak memiliki hak akses untuk membuka halaman ini.
                Mohon pastikan akun Anda memiliki izin yang sesuai atau
                hubungi administrator untuk informasi lebih lanjut.
            </p>

            <a href="{{ route('dashboard') }}"
                class="inline-block px-6 py-3 bg-gray-900 text-white font-medium rounded-lg shadow 
                       hover:bg-black transition-colors duration-200">
                Kembali ke Dashboard
            </a>

            <p class="text-xs text-gray-400 mt-6">
                Error Code: 403 • Forbidden
            </p>
        </div>

    </div>
</x-app-layout>
