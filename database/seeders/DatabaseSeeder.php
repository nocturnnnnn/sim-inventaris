<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Default
        User::firstOrCreate(
            ['email' => 'admin@inventaris.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Staf Default
        User::firstOrCreate(
            ['email' => 'staff@inventaris.com'],
            [
                'name' => 'Staf Gudang',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        // 3. Data Awal Inventaris Barang
        Item::firstOrCreate(
            ['kode_barang' => 'BRG-001'],
            [
                'nama_barang' => 'Laptop Dell XPS',
                'kategori' => 'Elektronik',
                'stok' => 15,
                'kondisi' => 'Baik',
            ]
        );

        Item::firstOrCreate(
            ['kode_barang' => 'BRG-002'],
            [
                'nama_barang' => 'Proyektor Epson',
                'kategori' => 'Elektronik',
                'stok' => 8,
                'kondisi' => 'Baik',
            ]
        );

        Item::firstOrCreate(
            ['kode_barang' => 'BRG-003'],
            [
                'nama_barang' => 'Kursi Kuliah',
                'kategori' => 'Mebel',
                'stok' => 120,
                'kondisi' => 'Rusak',
            ]
        );

        Supplier::firstOrCreate(
            ['kode_supplier' => 'SPL-001'],
            [
                'nama_supplier' => 'PT. Jaya Mandiri Elektronik',
                'kontak' => '0812-3456-7890',
                'alamat' => 'Jl. Industri No. 45, Jakarta Barat',
                'status' => 'Aktif',
            ]
        );

        Supplier::firstOrCreate(
            ['kode_supplier' => 'SPL-002'],
            [
                'nama_supplier' => 'CV. Sumber Mebel Abadi',
                'kontak' => '0821-9876-5432',
                'alamat' => 'Jl. Sentosa No. 12, Bandung',
                'status' => 'Aktif',
            ]
        );

        Supplier::firstOrCreate(
            ['kode_supplier' => 'SPL-003'],
            [
                'nama_supplier' => 'UD. Bina Sarana Lab',
                'kontak' => '0813-1122-3344',
                'alamat' => 'Jl. Raya Kampus No. 88, Surabaya',
                'status' => 'Nonaktif',
            ]
        );
    }
}
