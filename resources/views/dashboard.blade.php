<x-app-layout>
    <h2>SIM INVENTARIS KAMPUS</h2>
    <p>
        Login sebagai: <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }}) |
        <a href="{{ route('dashboard') }}">Dashboard</a> |
        <a href="{{ route('items.create') }}">+ Tambah Barang Baru</a>
        @if(auth()->user()->role === 'admin')
            | <a href="{{ route('users.index') }}">Kelola User</a>
        @endif
    </p>
    <hr>

    @if(session('success'))
        <p><b>Notifikasi:</b> {{ session('success') }}</p>
        <hr>
    @endif

    <h3>Ringkasan Statistik</h3>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <td>
                <b>TOTAL ITEM BARANG</b><br>
                {{ $totalJenis }} Jenis
            </td>
            <td>
                <b>TOTAL STOK FISIK</b><br>
                {{ $totalStok }} Unit
            </td>
            <td>
                <b>BARANG RUSAK / AFKIR</b><br>
                {{ $totalRusak }} Unit
            </td>
        </tr>
    </table>

    <br>
    <h3>Daftar Inventaris Barang</h3>

    <form method="GET" action="{{ route('dashboard') }}">
        <label>Kategori:</label>
        <select name="kategori" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach(['Elektronik', 'Mebel', 'Alat Tulis', 'Laboratorium'] as $kat)
                <option value="{{ $kat }}" @selected(request('kategori') == $kat)>{{ $kat }}</option>
            @endforeach
        </select>

        <label>Kondisi:</label>
        <select name="kondisi" onchange="this.form.submit()">
            <option value="">Semua Kondisi</option>
            <option value="Baik" @selected(request('kondisi') == 'Baik')>Baik</option>
            <option value="Rusak" @selected(request('kondisi') == 'Rusak')>Rusak</option>
        </select>

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode / nama...">
        <button type="submit">Cari</button>
    </form>
    <br>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>KODE</th>
                <th>NAMA BARANG</th>
                <th>KATEGORI</th>
                <th>STOK</th>
                <th>KONDISI</th>
                <th>FOTO</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>
                        @if($item->gambar)
                            <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('items.edit', $item) }}">Edit</a> |
                        <form method="POST" action="{{ route('items.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    {{ $items->links() }}
</x-app-layout>