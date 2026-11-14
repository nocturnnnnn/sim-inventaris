<x-app-layout>
    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header Card Kategori -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Kategori Inventaris Barang</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Pengelompokan barang inventaris sarana dan prasarana kampus.</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('items.create') }}" class="px-4 py-2 bg-[#2563eb] hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-lg shadow-sm transition inline-flex items-center gap-1.5">
                        <span>+ Tambah Barang Baru</span>
                    </a>
                </div>
            </div>

            <!-- Grid Kartu Kategori -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($categories as $cat)
                    @php
                        $icon = match($cat->nama) {
                            'Elektronik' => '⚡',
                            'Mebel' => '🪑',
                            'Alat Tulis' => '✏️',
                            'Laboratorium' => '🔬',
                            default => '📦'
                        };
                    @endphp
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 text-2xl flex items-center justify-center mb-4">
                                {{ $icon }}
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $cat->nama }}</h3>
                            <p class="text-xs text-gray-500 mt-1">Total: <span class="font-bold text-gray-800">{{ $cat->total_jenis }}</span> Jenis Barang</p>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 space-y-2 text-xs">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Stok Fisik:</span>
                                    <span class="font-bold text-blue-600">{{ $cat->total_stok }} Unit</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Kondisi Baik:</span>
                                    <span class="font-semibold text-emerald-600">{{ $cat->total_baik }} item</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Kondisi Rusak:</span>
                                    <span class="font-semibold text-rose-600">{{ $cat->total_rusak }} item</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-3">
                            <a href="{{ route('items.index', ['kategori' => $cat->nama]) }}"
                               class="w-full inline-flex justify-center items-center gap-1 py-2 px-3 text-xs font-semibold text-indigo-600 hover:text-white bg-indigo-50 hover:bg-indigo-600 rounded-lg transition">
                                Lihat Barang &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tabel Rekapitulasi Kategori -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-base font-bold text-gray-900">Tabel Rincian Kategori</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-xs sm:text-sm text-gray-700">
                        <thead class="bg-gray-50 text-gray-600 font-semibold uppercase text-[11px] border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3.5">Nama Kategori</th>
                                <th class="px-6 py-3.5">Jumlah Jenis Barang</th>
                                <th class="px-6 py-3.5">Total Stok Fisik</th>
                                <th class="px-6 py-3.5">Barang Baik</th>
                                <th class="px-6 py-3.5">Barang Rusak</th>
                                <th class="px-6 py-3.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($categories as $cat)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $cat->nama }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $cat->total_jenis }} jenis</td>
                                    <td class="px-6 py-4 font-bold text-blue-600">{{ $cat->total_stok }} unit</td>
                                    <td class="px-6 py-4 text-emerald-600 font-medium">{{ $cat->total_baik }} item</td>
                                    <td class="px-6 py-4 text-rose-600 font-medium">{{ $cat->total_rusak }} item</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('items.index', ['kategori' => $cat->nama]) }}"
                                           class="text-xs font-semibold text-blue-600 hover:underline">
                                            Buka Data Barang
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

