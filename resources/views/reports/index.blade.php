<x-app-layout>
    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header Card Laporan -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Laporan Rekapitulasi Inventaris</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Laporan berkala data fisik, kondisi, dan sebaran barang inventaris kampus.</p>
                </div>

                <div class="flex items-center gap-2.5">
                    <a href="{{ route('reports.print', request()->query()) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs sm:text-sm font-semibold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24-1.076-.642-2.072-1.185-2.956M12 3v13.5m0 0l-3.75-3.75M12 16.5l3.75-3.75M19.5 12a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"/>
                        </svg>
                        <span>Cetak Laporan / PDF</span>
                    </a>
                </div>
            </div>

            <!-- 4 Quick Stats Laporan -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Jenis</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalJenis }} <span class="text-xs text-gray-400 font-normal">Item</span></p>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Unit Fisik</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $totalStok }} <span class="text-xs text-gray-400 font-normal">Unit</span></p>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Kondisi Baik</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $totalBaik }} <span class="text-xs text-gray-400 font-normal">Item</span></p>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase">Kondisi Rusak</p>
                    <p class="text-2xl font-bold text-rose-600 mt-1">{{ $totalRusak }} <span class="text-xs text-gray-400 font-normal">Item</span></p>
                </div>
            </div>

            <!-- Rekapitulasi per Kategori -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="text-sm sm:text-base font-bold text-gray-800">Rekapitulasi per Kategori</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-xs sm:text-sm text-gray-700">
                        <thead class="bg-gray-50 text-gray-500 font-semibold uppercase text-[11px] border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Jumlah Item</th>
                                <th class="px-6 py-3">Total Unit Stok</th>
                                <th class="px-6 py-3">Barang Baik</th>
                                <th class="px-6 py-3">Barang Rusak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($categorySummary as $cat)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-3 font-semibold text-gray-800">{{ $cat->kategori }}</td>
                                    <td class="px-6 py-3">{{ $cat->total_jenis }} item</td>
                                    <td class="px-6 py-3 font-bold text-indigo-600">{{ $cat->total_stok ?? 0 }} unit</td>
                                    <td class="px-6 py-3 text-emerald-600 font-medium">{{ $cat->total_baik }} item</td>
                                    <td class="px-6 py-3 text-rose-600 font-medium">{{ $cat->total_rusak }} item</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-6 text-center text-gray-400">Belum ada data barang.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Filter Data Laporan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="text-sm sm:text-base font-bold text-gray-800">Rincian Data Barang Inventaris</h3>

                    <form method="GET" action="{{ route('reports.index') }}" class="flex flex-wrap items-center gap-2.5">
                        <select name="kategori" onchange="this.form.submit()"
                                class="text-xs sm:text-sm rounded-lg border-gray-200 bg-gray-50 text-gray-700 py-1.5 px-3">
                            <option value="">Semua Kategori</option>
                            @foreach(['Elektronik', 'Mebel', 'Alat Tulis', 'Laboratorium'] as $kat)
                                <option value="{{ $kat }}" @selected(request('kategori') == $kat)>{{ $kat }}</option>
                            @endforeach
                        </select>

                        <select name="kondisi" onchange="this.form.submit()"
                                class="text-xs sm:text-sm rounded-lg border-gray-200 bg-gray-50 text-gray-700 py-1.5 px-3">
                            <option value="">Semua Kondisi</option>
                            <option value="Baik" @selected(request('kondisi') == 'Baik')>Baik</option>
                            <option value="Rusak" @selected(request('kondisi') == 'Rusak')>Rusak</option>
                        </select>

                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                               class="text-xs sm:text-sm rounded-lg border-gray-200 bg-gray-50 py-1.5 px-3 w-36 sm:w-48">

                        <button type="submit" class="bg-indigo-600 text-white text-xs sm:text-sm font-medium px-3.5 py-1.5 rounded-lg hover:bg-indigo-700">
                            Filter
                        </button>
                        @if(request('kategori') || request('kondisi') || request('search'))
                            <a href="{{ route('reports.index') }}" class="text-xs text-gray-500 hover:underline">Reset</a>
                        @endif
                    </form>
                </div>

                <!-- Tabel Data Detail -->
                <div class="overflow-x-auto border border-gray-100 rounded-xl">
                    <table class="min-w-full text-left text-xs sm:text-sm text-gray-700">
                        <thead class="bg-gray-50 text-gray-600 font-semibold uppercase text-[11px] border-b border-gray-100">
                            <tr>
                                <th class="px-5 py-3">No</th>
                                <th class="px-5 py-3">Kode</th>
                                <th class="px-5 py-3">Nama Barang</th>
                                <th class="px-5 py-3">Kategori</th>
                                <th class="px-5 py-3">Stok</th>
                                <th class="px-5 py-3">Kondisi</th>
                                <th class="px-5 py-3">Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($items as $idx => $item)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-3 text-gray-400">{{ $items->firstItem() + $idx }}</td>
                                    <td class="px-5 py-3 font-mono font-medium">{{ $item->kode_barang }}</td>
                                    <td class="px-5 py-3 font-medium text-gray-900">{{ $item->nama_barang }}</td>
                                    <td class="px-5 py-3 text-gray-600">{{ $item->kategori }}</td>
                                    <td class="px-5 py-3 font-bold text-gray-900">{{ $item->stok }}</td>
                                    <td class="px-5 py-3">
                                        @if($item->kondisi === 'Baik')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Baik
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                Rusak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $item->created_at?->format('d/m/Y') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-5 py-8 text-center text-gray-400">Tidak ada data barang sesuai filter.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($items->hasPages())
                    <div class="pt-2">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

