<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-200">

                <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-200">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $supplier->exists ? 'Edit Supplier: ' . $supplier->nama_supplier : 'Tambah Supplier Baru' }}
                        </h2>
                    </div>
                    <a href="{{ route('suppliers.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center gap-1">
                        &larr; Kembali ke Data Supplier
                    </a>
                </div>

                <form method="POST"
                      action="{{ $supplier->exists ? route('suppliers.update', $supplier) : route('suppliers.store') }}"
                      class="space-y-5">
                    @csrf
                    @if($supplier->exists)
                        @method('PUT')
                    @endif

                    <div>
                        <label for="kode_supplier" class="block text-sm font-medium text-gray-700">Kode Supplier:</label>
                        <input type="text" id="kode_supplier" name="kode_supplier"
                               value="{{ old('kode_supplier', $supplier->kode_supplier) }}"
                               required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('kode_supplier')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_supplier" class="block text-sm font-medium text-gray-700">Nama Supplier/Vendor:</label>
                        <input type="text" id="nama_supplier" name="nama_supplier"
                               value="{{ old('nama_supplier', $supplier->nama_supplier) }}"
                               required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('nama_supplier')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak/No.Handphone:</label>
                        <input type="text" id="kontak" name="kontak"
                               value="{{ old('kontak', $supplier->kontak) }}"
                               required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('kontak')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap:</label>
                        <textarea id="alamat" name="alamat" rows="3" required
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('alamat', $supplier->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Kemitraan:</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="Aktif" @selected(old('status', $supplier->status ?? 'Aktif') == 'Aktif')>Aktif (Dapat menyuplai barang)</option>
                            <option value="Nonaktif" @selected(old('status', $supplier->status) == 'Nonaktif')>Nonaktif (Tidak aktif)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center gap-3 border-t border-gray-200">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition">
                            Simpan Data
                        </button>
                        <a href="{{ route('suppliers.index') }}" class="px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium text-sm border border-gray-300 rounded-lg shadow-sm transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
