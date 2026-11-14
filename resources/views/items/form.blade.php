<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-sm border border-gray-200">

                <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-200">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">
                            {{ $item->exists ? 'Edit Barang: ' . $item->nama_barang : 'Tambah Barang Baru' }}
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">Lengkapi informasi inventaris barang di bawah ini.</p>
                    </div>
                    <a href="{{ route('items.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center gap-1">
                        &larr; Kembali ke Kelola Barang
                    </a>
                </div>

                <form method="POST" enctype="multipart/form-data"
                      action="{{ $item->exists ? route('items.update', $item) : route('items.store') }}"
                      class="space-y-5">
                    @csrf
                    @if($item->exists)
                        @method('PUT')
                    @endif

                    <!-- Kode Barang -->
                    <div>
                        <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang:</label>
                        <input type="text" id="kode_barang" name="kode_barang"
                               value="{{ old('kode_barang', $item->kode_barang) }}"
                               required
                               placeholder="Contoh: BRG-001"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('kode_barang')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Barang -->
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
                        <input type="text" id="nama_barang" name="nama_barang"
                               value="{{ old('nama_barang', $item->nama_barang) }}"
                               required
                               placeholder="Contoh: Laptop Dell XPS"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('nama_barang')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori:</label>
                        <select id="kategori" name="kategori" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @foreach(['Elektronik', 'Mebel', 'Alat Tulis', 'Laboratorium'] as $kat)
                                <option value="{{ $kat }}" @selected(old('kategori', $item->kategori) == $kat)>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok Fisik:</label>
                        <input type="number" id="stok" name="stok" min="0"
                               value="{{ old('stok', $item->stok ?? 0) }}"
                               required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('stok')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kondisi -->
                    <div>
                        <label for="kondisi" class="block text-sm font-medium text-gray-700">Kondisi Barang:</label>
                        <select id="kondisi" name="kondisi" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="Baik" @selected(old('kondisi', $item->kondisi) == 'Baik')>Baik</option>
                            <option value="Rusak" @selected(old('kondisi', $item->kondisi) == 'Rusak')>Rusak</option>
                        </select>
                        @error('kondisi')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Barang -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Foto Barang (Opsional):</label>
                        @if($item->exists && $item->gambar)
                            <div class="mt-2 mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200 flex items-center gap-4">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-16 h-16 object-cover rounded-md border border-gray-300">
                                <div>
                                    <p class="text-xs font-medium text-gray-700">Foto saat ini</p>
                                    <p class="text-xs text-gray-500">Pilih file baru di bawah ini jika ingin mengganti foto.</p>
                                </div>
                            </div>
                        @endif
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('gambar')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 flex items-center gap-3 border-t border-gray-200">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition">
                            Simpan
                        </button>
                        <a href="{{ route('items.index') }}" class="px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-medium text-sm border border-gray-300 rounded-lg shadow-sm transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
