<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris Kampus</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1a202c;
            margin: 0;
            padding: 24px;
            background: #fff;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #1a202c;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0 0 4px 0;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header h2 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: normal;
        }
        .header p {
            margin: 0;
            font-size: 11px;
            color: #4a5568;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 11px;
        }
        .summary-box {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        .summary-item {
            flex: 1;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            padding: 8px 12px;
            background: #f7fafc;
        }
        .summary-item .label {
            font-size: 10px;
            text-transform: uppercase;
            color: #718096;
            margin-bottom: 2px;
        }
        .summary-item .value {
            font-size: 14px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        th, td {
            border: 1px solid #cbd5e0;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background-color: #edf2f7;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            width: 200px;
            text-align: center;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #1a202c;
            font-weight: bold;
            padding-top: 4px;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 16px; display: flex; gap: 8px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            🖨️ Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #e2e8f0; color: #1a202c; border: none; border-radius: 4px; cursor: pointer;">
            Tutup
        </button>
    </div>

    <!-- Kop Surat Kampus -->
    <div class="header">
        <h1>SISTEM INFORMASI MANAJEMEN INVENTARIS KAMPUS</h1>
        <h2>UNIT PENGELOLA SARANA DAN PRASARANA INSTITUSI</h2>
        <p>Jl. Kampus Terpadu No. 1 • Telp: (021) 123-4567 • Email: inventaris@kampus.ac.id</p>
    </div>

    <!-- Informasi Laporan -->
    <div class="meta-info">
        <div>
            <strong>Perihal:</strong> Laporan Data Fisik & Kondisi Barang Inventaris<br>
            <strong>Filter Kategori:</strong> {{ $kategori ?: 'Semua Kategori' }} | <strong>Kondisi:</strong> {{ $kondisi ?: 'Semua Kondisi' }}
        </div>
        <div class="text-right">
            <strong>Tanggal Cetak:</strong> {{ date('d F Y') }}<br>
            <strong>Dicetak Oleh:</strong> {{ auth()->user()->name }} ({{ strtoupper(auth()->user()->role) }})
        </div>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="summary-box">
        <div class="summary-item">
            <div class="label">Total Jenis Barang</div>
            <div class="value">{{ $totalJenis }} Jenis</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Stok Fisik</div>
            <div class="value">{{ $totalStok }} Unit</div>
        </div>
        <div class="summary-item">
            <div class="label">Barang Kondisi Baik</div>
            <div class="value">{{ $totalBaik }} Item</div>
        </div>
        <div class="summary-item">
            <div class="label">Barang Rusak / Afkir</div>
            <div class="value">{{ $totalRusak }} Item</div>
        </div>
    </div>

    <!-- Tabel Data Barang -->
    <table>
        <thead>
            <tr>
                <th style="width: 30px;" class="text-center">No</th>
                <th style="width: 80px;">Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th style="width: 60px;" class="text-right">Stok</th>
                <th style="width: 70px;" class="text-center">Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $i => $item)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td><strong>{{ $item->kode_barang }}</strong></td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td class="text-right">{{ $item->stok }}</td>
                    <td class="text-center">{{ $item->kondisi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Tidak ada data barang inventaris yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan Pengesahan -->
    <div class="signature-section">
        <div class="signature-box">
            <div>Mengetahui,</div>
            <div style="font-size: 11px; margin-top: 2px;">Pengelola Inventaris Kampus</div>
            <div class="signature-line">
                {{ auth()->user()->name }}
            </div>
        </div>
    </div>

    <script>
        // Otomatis membuka dialog print
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 400);
        };
    </script>
</body>
</html>

