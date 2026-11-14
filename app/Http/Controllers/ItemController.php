<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard', $request->query());
    }

    public function create()
    {
        return view('items.form', ['item' => new Item]);
    }

    public function store(Request $request)
    {
        // Validasi sesuai soal: kode_barang unik, nama_barang wajib, stok minimal 0
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:50', 'unique:items,kode_barang'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'stok' => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', 'in:Baik,Rusak'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if ($file) {
                $validated['gambar'] = $file->store('items', 'public');
            }
        }

        Item::create($validated);

        return redirect()->route('dashboard')->with('success', 'Barang baru berhasil ditambahkan!');
    }

    public function show(Item $item)
    {
        return redirect()->route('dashboard');
    }

    public function edit(Item $item)
    {
        return view('items.form', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:50', Rule::unique('items', 'kode_barang')->ignore($item->id)],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'stok' => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', 'in:Baik,Rusak'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $file = $request->file('gambar');
            if ($file) {
                $validated['gambar'] = $file->store('items', 'public');
            }
        } else {
            unset($validated['gambar']);
        }

        $item->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();

        return redirect()->route('dashboard')->with('success', 'Barang berhasil dihapus!');
    }
}
