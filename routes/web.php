<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahunAjarController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('auth')->group(function () {

    // Dashboard bebas semua role
    Route::middleware('can:izin-siswa')->group(function () {

    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin + Guru
    Route::middleware('can:izin-guru-admin')->group(function () {
        Route::resource('tahunajar', TahunAjarController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('siswa', SiswaController::class);
    });

    // Admin only
    Route::middleware('can:izin-admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Profile semua role bisa
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
