<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $defaultCategories = ['Elektronik', 'Mebel', 'Alat Tulis', 'Laboratorium'];

        // Ambil data agregasi per kategori dari database
        $stats = Item::selectRaw('kategori, count(*) as total_jenis, sum(stok) as total_stok, sum(case when kondisi = "Rusak" then 1 else 0 end) as total_rusak, sum(case when kondisi = "Baik" then 1 else 0 end) as total_baik')
            ->groupBy('kategori')
            ->get()
            ->keyBy('kategori');

        $categories = collect($defaultCategories)->map(function ($name) use ($stats) {
            $data = $stats->get($name);
            return (object) [
                'nama' => $name,
                'total_jenis' => $data->total_jenis ?? 0,
                'total_stok' => $data->total_stok ?? 0,
                'total_rusak' => $data->total_rusak ?? 0,
                'total_baik' => $data->total_baik ?? 0,
            ];
        });

        // Kategori lain jika ada di database
        $otherCategories = Item::whereNotIn('kategori', $defaultCategories)
            ->selectRaw('kategori, count(*) as total_jenis, sum(stok) as total_stok, sum(case when kondisi = "Rusak" then 1 else 0 end) as total_rusak, sum(case when kondisi = "Baik" then 1 else 0 end) as total_baik')
            ->groupBy('kategori')
            ->get()
            ->map(function ($data) {
                return (object) [
                    'nama' => $data->kategori,
                    'total_jenis' => $data->total_jenis,
                    'total_stok' => $data->total_stok,
                    'total_rusak' => $data->total_rusak,
                    'total_baik' => $data->total_baik,
                ];
            });

        $categories = $categories->merge($otherCategories);

        return view('categories.index', compact('categories'));
    }
}

