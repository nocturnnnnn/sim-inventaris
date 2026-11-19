<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('nama_supplier', 'like', '%'.$request->search.'%')
                        ->orWhere('kode_supplier', 'like', '%'.$request->search.'%')
                        ->orWhere('kontak', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalSupplier = Supplier::count();
        $totalAktif = Supplier::where('status', 'Aktif')->count();
        $totalNonaktif = Supplier::where('status', 'Nonaktif')->count();

        return view('suppliers.index', compact('suppliers', 'totalSupplier', 'totalAktif', 'totalNonaktif'));
    }

    public function create()
    {
        return view('suppliers.form', ['supplier' => new Supplier(['status' => 'Aktif'])]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier' => ['required', 'string', 'max:50', 'unique:suppliers,kode_supplier'],
            'nama_supplier' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
        ]);

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Data supplier '.$validated['nama_supplier'].' berhasil ditambahkan!');
    }

    public function show(Supplier $supplier)
    {
        return redirect()->route('suppliers.edit', $supplier);
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.form', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'kode_supplier' => ['required', 'string', 'max:50', Rule::unique('suppliers', 'kode_supplier')->ignore($supplier->id)],
            'nama_supplier' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Data supplier '.$supplier->nama_supplier.' berhasil diperbarui!');
    }

    public function destroy(Supplier $supplier)
    {
        $nama = $supplier->nama_supplier;
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier '.$nama.' berhasil dihapus!');
    }
}
