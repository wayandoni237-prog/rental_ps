<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'nama'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@psgalaxy.id',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Buat Tamu Contoh
        User::create([
            'nama'     => 'Budi Santoso',
            'username' => 'budi',
            'email'    => 'budi@example.com',
            'password' => Hash::make('budi123'),
            'role'     => 'tamu',
        ]);

        // Buat Ruangan Contoh
        Ruangan::create([
            'nama_ruangan'  => 'Room PS5 VIP A',
            'deskripsi'     => 'Ruangan VIP dengan PS5 terbaru, TV OLED 65 inch 4K, kursi gaming premium, dan AC eksklusif.',
            'harga_normal'  => 200000,
            'harga_diskon'  => 150000,
            'persen_diskon' => 25,
            'kapasitas'     => 4,
            'status'        => 'tersedia',
        ]);

        Ruangan::create([
            'nama_ruangan'  => 'Room PS5 Regular B',
            'deskripsi'     => 'Ruangan nyaman dengan PS5, TV 55 inch, sistem audio stereo, cocok untuk 2-3 orang.',
            'harga_normal'  => 150000,
            'harga_diskon'  => null,
            'persen_diskon' => null,
            'kapasitas'     => 3,
            'status'        => 'tersedia',
        ]);

        Ruangan::create([
            'nama_ruangan'  => 'Room PS4 Duo C',
            'deskripsi'     => 'Ruangan PS4 untuk 2 orang dengan setting gaming yang nyaman dan harga terjangkau.',
            'harga_normal'  => 100000,
            'harga_diskon'  => 80000,
            'persen_diskon' => 20,
            'kapasitas'     => 2,
            'status'        => 'tersedia',
        ]);
    }
}