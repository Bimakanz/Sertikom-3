<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Cek apakah user admin sudah ada sebelum membuatnya
        $adminEmail = 'adminkeren@gmail.com';
        if (!User::where('email', $adminEmail)->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password'=> bcrypt('password'),
                'role' => 'admin',
            ]);
        }
    }
}
