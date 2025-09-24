<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Perintah ini akan mengosongkan tabel users sebelum diisi lagi.
        // User::truncate();

        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Membuat Akun ADMIN
        User::create([
            'name' => 'Admin Balikin',
            'email' => 'admin@balikin.test',
            'password' => Hash::make('admin123'), // password: admin123
            'jurusan' => 'Administrasi',
            'nomor_telepon' => '081200000001',
            'role' => 'admin',
        ]);

        // 2. Membuat Akun untuk TIM PENGEMBANG
        User::create([
            'name' => 'Ferdi', // Ganti dengan nama Anda
            'email' => 'ferdi@balikin.test',
            'password' => Hash::make('password'), // password: password
            'nim' => 'D1234567890', // Ganti dengan NIM Anda
            'jurusan' => 'Teknik Informatika',
            'nomor_telepon' => '081200000002',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Ariella', // Ganti dengan nama teman Anda
            'email' => 'ariella@balikin.test',
            'password' => Hash::make('password'), // password: password
            'nim' => 'D0987654321', // Ganti dengan NIM teman Anda
            'jurusan' => 'Sistem Informasi',
            'nomor_telepon' => '081200000003',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Erika', // Ganti dengan nama teman Anda
            'email' => 'erika@balikin.test',
            'password' => Hash::make('password'), // password: password
            'nim' => 'D5432109876', // Ganti dengan NIM teman Anda
            'jurusan' => 'Desain Komunikasi Visual',
            'nomor_telepon' => '081200000004',
            'role' => 'user',
        ]);
    }
}
