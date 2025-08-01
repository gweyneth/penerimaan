<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // <-- Pastikan ini di-import

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'adminjiva@gmail.com',
            'password' => Hash::make('j1va4bisatya'), // Ganti dengan password aman
            'role' => 'admin',
        ]);

        // Membuat Akun Siswa
        User::create([
            'name' => 'Siswa Test',
            'email' => 'testsiswa@gmail.com',
            'password' => Hash::make('siswa**//'), // Ganti dengan password aman
            'role' => 'siswa',
        ]);
    }
}