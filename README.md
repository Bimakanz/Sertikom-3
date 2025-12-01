# Sertikom-3 - Sistem Informasi Sertifikasi Komputer

Sistem informasi manajemen sertifikasi komputer yang dibangun menggunakan Laravel 11. Aplikasi ini dirancang untuk mengelola data siswa, kelas, jurusan, dan tahun ajar serta mencatat aktivitas sistem.

## Fitur Utama

- Manajemen data siswa (NISN, nama, jenis kelamin, tanggal lahir, alamat)
- Manajemen kelas dan jurusan
- Manajemen tahun ajar
- Pelacakan perubahan kelas siswa (riwayat kelas)
- Catatan aktivitas sistem (Activity Log)
- Fitur pencarian data
- Sistem otentikasi dan otorisasi berbasis role (admin, guru, siswa)
- Dashboard dengan statistik dan aktivitas terbaru
- Manajemen pengguna sistem (khusus admin)
- Sistem profil pengguna

## Instalasi

1. Clone repository:
   ```bash
   git clone <repository-url>
   cd Sertikom-3
   ```

2. Install dependensi:
   ```bash
   composer install
   npm install
   ```

3. Konfigurasi environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Konfigurasi database di file `.env`

5. Jalankan migrasi dan seeding:
   ```bash
   php artisan migrate --seed
   ```

6. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```

## Struktur Database

Aplikasi ini menggunakan beberapa tabel utama:

- `users` - Data pengguna sistem
- `siswas` - Data siswa (nisn, nama, jenis kelamin, dll)
- `jurusans` - Data jurusan (nama jurusan, kode jurusan)
- `kelas` - Data kelas (nama kelas, level kelas, jurusan_id, tahun_ajar_id)
- `tahun_ajars` - Data tahun ajar (nama_tahun_ajar, kode_tahun_ajar)
- `kelas_details` - Riwayat perubahan kelas siswa
- `activity_logs` - Catatan aktivitas sistem

## Fitur Pencarian (Search)

Fitur pencarian diimplementasikan di `SiswaController.php` menggunakan metode `index`:

```php
public function index(Request $request)
{
    $search = $request->get('search');

    $query = Siswa::with(['kelas', 'jurusan', 'tahun_ajar']);

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nisn', 'LIKE', "%{$search}%")
              ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
              ->orWhere('alamat', 'LIKE', "%{$search}%")
              ->orWhereHas('kelas', function($q) use ($search) {
                  $q->where('nama_kelas', 'LIKE', "%{$search}%")
                    ->orWhere('level_kelas', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('jurusan', function($q) use ($search) {
                  $q->where('nama_jurusan', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('tahun_ajar', function($q) use ($search) {
                  $q->where('nama_tahun_ajar', 'LIKE', "%{$search}%");
              });
        });
    }
    // ...
}
```

### Cara Kerja Search:
- Mencari di beberapa kolom: nisn, nama_lengkap, alamat
- Mencari di relasi: kelas, jurusan, tahun ajar
- Menggunakan fungsi `whereHas` untuk mencari pada model terkait
- Menggunakan fungsi `orWhere` untuk mencari di beberapa kolom secara paralel

## Sistem Otorisasi Berbasis Role (Authorization)

Aplikasi ini dilengkapi dengan sistem otorisasi berbasis role menggunakan Laravel Gates yang didefinisikan di `AppServiceProvider.php`:

```php
public function boot(): void
{
    Gate::define('izin-admin', function ($user) {
        return $user->role === 'admin';
    });

    Gate::define('izin-guru-admin', function ($user) {
        return in_array($user->role, ['admin', 'guru']);
    });
}
```

### Jenis Role:
- `admin`: Akses penuh ke semua fitur, termasuk manajemen pengguna
- `guru`: Akses ke fitur manajemen siswa, kelas, jurusan, dan tahun ajar
- `siswa`: Akses terbatas, hanya ke profil dan dashboard

### Implementasi Middleware:
- `can:izin-admin`: Hanya untuk admin (contoh: manajemen pengguna)
- `can:izin-guru-admin`: Untuk admin dan guru (contoh: manajemen siswa)
- `can:izin-siswa`: Untuk semua role termasuk siswa (contoh: dashboard)

## Dashboard dengan Statistik dan Aktivitas

Dashboard menampilkan informasi statistik dan aktivitas terbaru dalam sistem:

### Statistik:
- Total siswa
- Total jurusan
- Total kelas
- Total pengguna (hanya untuk admin)

### Aktivitas Terbaru:
- Menampilkan 5 aktivitas terakhir dari tabel `activity_logs`
- Fitur pagination untuk melihat lebih banyak aktivitas
- Informasi waktu aktivitas (format: tanggal dan "x waktu yang lalu")

### DashboardController:
```php
public function index()
{
    $siswaCount = Siswa::count();
    $jurusanCount = Jurusan::count();
    $kelasCount = Kelas::count();
    $userCount = User::count();
    $recentActivities = ActivityLog::latest()->paginate(5);

    return view('dashboard', compact(
        'siswaCount',
        'jurusanCount',
        'kelasCount',
        'userCount',
        'recentActivities'
    ));
}
```

## Struktur Route dengan Grup Middleware

Route diorganisir dalam grup middleware berdasarkan role:

```php
Route::middleware('auth')->group(function () {

    // Dashboard bebas semua role
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
```

## Manajemen Pengguna (User Management)

Fitur manajemen pengguna memungkinkan admin untuk:
- Melihat daftar pengguna
- Membuat pengguna baru
- Mengedit informasi pengguna
- Menghapus pengguna
- Mengatur role pengguna (admin, guru, siswa)

Fitur ini hanya tersedia untuk role admin melalui `UserController`.

## Membuat Database Seeder

Seeder digunakan untuk mengisi data dummy saat pengembangan. Cara membuat seeder:

### 1. Membuat seeder baru:
```bash
php artisan make:seeder NamaSeeder
```

### 2. Contoh struktur seeder:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ganti dengan model yang sesuai

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hanya membuat jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Kondisi unik
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );
    }
}
```

### 3. Menambahkan ke DatabaseSeeder:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // Tambahkan seeder lain di sini
        ]);
    }
}
```

### 4. Menjalankan seeder:
```bash
# Hanya menjalankan seeder
php artisan db:seed

# Menjalankan migrasi dan seeder
php artisan migrate --seed

# Menjalankan seeder tertentu
php artisan db:seed --class=UserSeeder
```

## Struktur Folder Penting

```
app/
├── Http/
│   └── Controllers/
│       ├── DashboardController.php    # Controller dashboard
│       ├── SiswaController.php        # Controller utama siswa
│       ├── UserController.php         # Controller manajemen pengguna (admin)
│       ├── TahunAjarController.php    # Controller tahun ajar
│       ├── JurusanController.php      # Controller jurusan
│       ├── KelasController.php        # Controller kelas
│       ├── ProfileController.php      # Controller profil pengguna
│       └── ...
├── Models/
│   ├── User.php                     # Model pengguna (dengan role)
│   ├── Siswa.php                    # Model siswa
│   ├── Kelas.php                    # Model kelas
│   ├── Jurusan.php                  # Model jurusan
│   ├── TahunAjar.php                # Model tahun ajar
│   ├── KelasDetail.php              # Model riwayat kelas
│   └── ActivityLog.php              # Model log aktivitas
├── Providers/
│   └── AppServiceProvider.php       # Service provider dengan Gate definitions
└── ...

resources/
├── views/
│   ├── siswa/                       # View untuk siswa
│   │   ├── index.blade.php          # Halaman daftar siswa
│   │   ├── create.blade.php         # Halaman tambah siswa
│   │   ├── edit.blade.php           # Halaman edit siswa
│   │   └── detailsiswa.blade.php    # Halaman detail siswa
│   ├── dashboard.blade.php          # Halaman dashboard utama
│   └── ...
└── ...

database/
├── migrations/                      # File migrasi database
├── seeders/                         # File seeder
└── factories/                       # File factory
```

## Hubungan Antar Model (Relationships)

### User Model
```php
// Role-based access
public function getRole()
{
    return $this->attributes['role'] ?? null;
}
```

### Siswa Model
```php
// Relasi ke kelas
public function kelas()
{
    return $this->belongsTo(Kelas::class);
}

// Relasi ke tahun ajar
public function tahun_ajar()
{
    return $this->belongsTo(TahunAjar::class, 'tahun_ajar_id','id');
}

// Relasi ke jurusan
public function jurusan()
{
    return $this->belongsTo(Jurusan::class);
}

// Relasi ke kelas detail (riwayat kelas)
public function kelas_details()
{
    return $this->hasMany(KelasDetail::class);
}
```

### Kelas Model
```php
// Relasi ke jurusan
public function jurusan()
{
    return $this->belongsTo(Jurusan::class);
}

// Relasi ke siswa
public function siswas()
{
    return $this->hasMany(Siswa::class);
}
```

### ActivityLog Model
```php
// Relasi ke user yang melakukan aktivitas
public function user()
{
    return $this->belongsTo(User::class);
}
```

## Fitur Update Kelas Siswa

Aplikasi memiliki fitur untuk mengganti kelas siswa yang mencakup:

1. Mengecek apakah permintaan datang dari halaman detail siswa atau halaman edit biasa
2. Menonaktifkan riwayat kelas sebelumnya (mengganti status menjadi "Tidak Aktif")
3. Membuat riwayat kelas baru (dengan status "Aktif")
4. Mencatat aktivitas perubahan

## Catatan Aktivitas Sistem (Activity Log)

Setiap perubahan data siswa (tambah, edit, hapus) akan dicatat di tabel `activity_logs`:

- Ditambahkan saat menyimpan siswa baru
- Ditambahkan saat mengupdate data siswa
- Ditambahkan saat mengganti kelas siswa
- Ditambahkan saat menghapus siswa

## Cara Membuat Fitur-fitur Utama

### 1. Membuat Model
```bash
php artisan make:model NamaModel
```

Contoh lengkap dengan migration dan factory:
```bash
php artisan make:model NamaModel -m -f
```

### 2. Membuat Migration
```bash
php artisan make:migration create_nama_table
```

Struktur migration umum:
```php
Schema::create('table_name', function (Blueprint $table) {
    $table->id();
    $table->string('nama_field');
    $table->foreignId('relasi_id')->constrained();
    $table->timestamps();
});
```

### 3. Membuat Controller
```bash
php artisan make:controller NamaController
```

Controller resource (membuat CRUD otomatis):
```bash
php artisan make:controller NamaController --resource
```

### 4. Membuat View
Buat file Blade dalam folder `resources/views/`:
```
resources/views/nama_folder/nama_file.blade.php
```

### 5. Membuat Route
Tambahkan di `routes/web.php`:
```php
Route::resource('nama', NamaController::class);
```

Atau route manual:
```php
Route::get('/nama', [NamaController::class, 'index'])->name('nama.index');
Route::post('/nama', [NamaController::class, 'store'])->name('nama.store');
```

### 6. Membuat Seeder (Penjelasan Ringkas)
```bash
php artisan make:seeder NamaSeeder
```

Struktur dasar seeder:
```php
public function run()
{
    Model::create([
        'field' => 'value'
    ]);
}
```

### 7. Membuat Factory
Factory otomatis dibuat dengan model:
```bash
php artisan make:model NamaModel -f
```

### 8. Membuat Relasi Antar Model
Contoh relasi `belongsTo`:
```php
public function relasi()
{
    return $this->belongsTo(ModelRelasi::class);
}
```

Contoh relasi `hasMany`:
```php
public function relasi()
{
    return $this->hasMany(ModelRelasi::class);
}
```

### 9. Membuat Fitur Pencarian (Search)
Contoh dasar pencarian:
```php
$query = Model::query();

if ($request->search) {
    $query->where('field', 'LIKE', "%{$request->search}%");
}
```

### 10. Membuat Validasi Formulir
Di controller:
```php
$request->validate([
    'field' => 'required|unique:table_name,field'
]);
```

### 11. Membuat Pagination
Di controller:
```php
$data = Model::paginate(10);
```

Di view:
```blade
{{ $data->links() }}
```

### 12. Membuat Activity Log
Di controller setelah operasi:
```php
ActivityLog::create([
    'description' => 'Deskripsi aktivitas'
]);
```

## Tips dan Panduan Pengembangan

### 1. Pengelolaan Relasi
- Gunakan `with()` untuk eager loading relasi untuk mencegah N+1 query problem
- Gunakan `whereHas()` untuk mencari data berdasarkan relasi

### 2. Validasi Formulir
- Gunakan `unique` rule untuk mencegah duplikasi data
- Gunakan `exists` rule untuk memvalidasi foreign keys

### 3. Paginasi
- Gunakan `paginate()` di controller dan `->links()` di view
- Gunakan `appends()` untuk mempertahankan parameter pencarian saat paginasi

### 4. Keamanan
- Selalu hash password sebelum menyimpan
- Gunakan `bcrypt()` untuk hashing password
- Gunakan `validated()` untuk mengambil data yang telah divalidasi

## Saran Peningkatan untuk Aplikasi

### 1. Fitur Keamanan
- Implementasi two-factor authentication (2FA)
- Tambahkan role-based access control yang lebih kompleks
- Implementasi rate limiting untuk mencegah abuse API
- Tambahkan fitur password strength validator

### 2. Performansi
- Implementasi caching dengan Redis/Memcached
- Gunakan queue untuk operasi berat (email, notifikasi)
- Implementasi soft deletes untuk data penting
- Tambahkan indeks pada kolom yang sering digunakan untuk pencarian

### 3. Antarmuka Pengguna
- Tambahkan fitur export data (PDF, Excel)
- Implementasi live search dengan AJAX
- Tambahkan fitur filter lanjutan (tanggal, rentang usia, dll)
- Gunakan JavaScript framework (Alpine.js, Vue.js) untuk UX yang lebih interaktif

### 4. Analisis Data
- Tambahkan dashboard statistik (jumlah siswa per jurusan, per tahun ajar)
- Implementasi grafik dengan Chart.js atau Laravel Charts
- Fitur laporan bulanan/tahunan dalam bentuk PDF
- Sistem notifikasi untuk pengingat penting

### 5. Fitur Tambahan
- Sistem autentikasi multi-role (admin, guru, siswa)
- Fitur upload foto siswa
- Sistem backup otomatis database
- API endpoints untuk integrasi mobile app
- Sistem audit trail yang lebih komprehensif

### 6. Testing
- Implementasi unit test dan feature test
- Gunakan Laravel Dusk untuk browser testing
- Implementasi CI/CD pipeline
- Code coverage analysis

## Komponen Tekis

- **Framework**: Laravel 11
- **Database**: MySQL (dapat diganti dengan database lain)
- **CSS Framework**: Tailwind CSS (melalui Vite)
- **JavaScript**: Vite untuk build assets
- **Server**: PHP 8.2+

## Kontribusi

Kontribusi sangat diterima! Jika Anda ingin berkontribusi:

1. Fork repository
2. Buat branch fitur (`git checkout -b fitur/AwesomeFeature`)
3. Commit perubahan Anda (`git commit -m 'Add some AwesomeFeature'`)
4. Push ke branch (`git push origin fitur/AwesomeFeature`)
5. Buka Pull Request

## Lisensi

Project ini dilisensikan di bawah lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.
