<x-app-layout>
    <h2>{{ $item->exists ? 'Edit Barang: ' . $item->nama_barang : 'Tambah Barang Baru' }}</h2>
    <p><a href="{{ route('dashboard') }}">Kembali ke Dashboard</a></p>
    <hr>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $item->exists ? route('items.update', $item) : route('items.store') }}">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        <p>
            <label>Kode Barang:</label><br>
            <input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" required>
            @error('kode_barang') <br><small>{{ $message }}</small> @enderror
        </p>

        <p>
            <label>Nama Barang:</label><br>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" required>
            @error('nama_barang') <br><small>{{ $message }}</small> @enderror
        </p>

        <p>
            <label>Kategori:</label><br>
            <select name="kategori">
                @foreach(['Elektronik', 'Mebel', 'Alat Tulis', 'Laboratorium'] as $kat)
                    <option value="{{ $kat }}" @selected(old('kategori', $item->kategori) == $kat)>{{ $kat }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Stok:</label><br>
            <input type="number" name="stok" min="0" value="{{ old('stok', $item->stok ?? 0) }}" required>
            @error('stok') <br><small>{{ $message }}</small> @enderror
        </p>

        <p>
            <label>Kondisi:</label><br>
            <select name="kondisi">
                <option value="Baik" @selected(old('kondisi', $item->kondisi) == 'Baik')>Baik</option>
                <option value="Rusak" @selected(old('kondisi', $item->kondisi) == 'Rusak')>Rusak</option>
            </select>
        </p>

        <p>
            <label>Foto Barang (Opsional):</label><br>
            @if($item->exists && $item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}" width="120" style="margin-bottom: 8px; border-radius: 4px;"><br>
                <small>Pilih file baru jika ingin mengganti foto saat ini.</small><br>
            @endif
            <input type="file" name="gambar" accept="image/*">
            @error('gambar') <br><small style="color: red;">{{ $message }}</small> @enderror
        </p>

        <p>
            <button type="submit">Simpan</button>
            <a href="{{ route('dashboard') }}">Batal</a>
        </p>
    </form>
</x-app-layout>