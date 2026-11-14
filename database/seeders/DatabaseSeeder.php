<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin Default Wajib (admin@battle.com)
        User::create([
            'name' => 'Admin Demo',
            'email' => 'admin@battle.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        // 2. User Staff Dummy
        User::create([
            'name' => 'Staf Gudang',
            'email' => 'staff@battle.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);
        // 3. Data Barang Dummy Sesuai Wireframe Soal Paket 1
        Item::create([
            'kode_barang' => 'BRG-001',
            'nama_barang' => 'Laptop Dell XPS',
            'kategori' => 'Elektronik',
            'stok' => 15,
            'kondisi' => 'Baik',
        ]);
        Item::create([
            'kode_barang' => 'BRG-002',
            'nama_barang' => 'Proyektor Epson',
            'kategori' => 'Elektronik',
            'stok' => 8,
            'kondisi' => 'Baik',
        ]);
        Item::create([
            'kode_barang' => 'BRG-003',
            'nama_barang' => 'Kursi Kuliah',
            'kategori' => 'Mebel',
            'stok' => 120,
            'kondisi' => 'Rusak',
        ]);
    }
}
