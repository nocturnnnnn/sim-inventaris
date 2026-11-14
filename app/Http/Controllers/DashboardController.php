<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 3 Widget Ringkasan Statistik Sesuai Wireframe
        $totalJenis = Item::count();
        $totalStok = Item::sum('stok') ?? 0;
        $totalRusak = Item::where('kondisi', 'Rusak')->count();

        // Filter Kategori, Filter Kondisi, & Pencarian Kode/Nama Barang
        $items = Item::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('nama_barang', 'like', '%'.$request->search.'%')
                        ->orWhere('kode_barang', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->kategori, fn ($q) => $q->where('kategori', $request->kategori))
            ->when($request->kondisi, fn ($q) => $q->where('kondisi', $request->kondisi))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard', compact('totalJenis', 'totalStok', 'totalRusak', 'items'));
    }
}
