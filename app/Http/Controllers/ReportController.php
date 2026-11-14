<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $kondisi = $request->kondisi;
        $search = $request->search;

        $query = Item::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama_barang', 'like', '%'.$search.'%')
                        ->orWhere('kode_barang', 'like', '%'.$search.'%');
                });
            })
            ->when($kategori, fn ($q) => $q->where('kategori', $kategori))
            ->when($kondisi, fn ($q) => $q->where('kondisi', $kondisi));

        $items = (clone $query)->latest()->paginate(15)->withQueryString();

        // Ringkasan per Kategori
        $categorySummary = Item::selectRaw('kategori, count(*) as total_jenis, sum(stok) as total_stok, sum(case when kondisi = "Rusak" then 1 else 0 end) as total_rusak, sum(case when kondisi = "Baik" then 1 else 0 end) as total_baik')
            ->groupBy('kategori')
            ->get();

        $totalJenis = Item::count();
        $totalStok = Item::sum('stok') ?? 0;
        $totalRusak = Item::where('kondisi', 'Rusak')->count();
        $totalBaik = Item::where('kondisi', 'Baik')->count();

        return view('reports.index', compact(
            'items',
            'categorySummary',
            'totalJenis',
            'totalStok',
            'totalRusak',
            'totalBaik',
            'kategori',
            'kondisi',
            'search'
        ));
    }

    public function print(Request $request)
    {
        $kategori = $request->kategori;
        $kondisi = $request->kondisi;

        $items = Item::query()
            ->when($kategori, fn ($q) => $q->where('kategori', $kategori))
            ->when($kondisi, fn ($q) => $q->where('kondisi', $kondisi))
            ->latest()
            ->get();

        $totalJenis = $items->count();
        $totalStok = $items->sum('stok');
        $totalRusak = $items->where('kondisi', 'Rusak')->count();
        $totalBaik = $items->where('kondisi', 'Baik')->count();

        return view('reports.print', compact(
            'items',
            'totalJenis',
            'totalStok',
            'totalRusak',
            'totalBaik',
            'kategori',
            'kondisi'
        ));
    }
}

