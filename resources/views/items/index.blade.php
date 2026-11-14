<x-app-layout>
    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Notification -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between text-sm shadow-sm">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span><b>Notifikasi:</b> {{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Table Card Section (Data Barang) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <!-- Table Header & Action -->
                <div class="p-6 pb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase tracking-wide">
                            DATA INVENTARIS BARANG
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Kelola data fisik, stok, dan kondisi barang kampus.</p>
                    </div>

                    <a href="{{ route('items.create') }}"
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#2563eb] hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-lg shadow-sm transition">
                        <span>+ Tambah Barang Baru</span>
                    </a>
                </div>

                <!-- Filters Bar -->
                <div class="px-6 pb-5">
                    <form method="GET" action="{{ route('items.index') }}" class="flex flex-wrap items-center gap-3">
                        <!-- Filter Kategori -->
                        <div class="relative">
                            <select name="kategori" onchange="this.form.submit()"
                                    class="text-xs sm:text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white text-gray-700 py-2 pl-3 pr-8 shadow-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Kategori</option>
                                @foreach(['Elektronik', 'Mebel', 'Alat Tulis', 'Laboratorium'] as $kat)
                                    <option value="{{ $kat }}" @selected(request('kategori') == $kat)>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Kondisi -->
                        <div class="relative">
                            <select name="kondisi" onchange="this.form.submit()"
                                    class="text-xs sm:text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white text-gray-700 py-2 pl-3 pr-8 shadow-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Kondisi</option>
                                <option value="Baik" @selected(request('kondisi') == 'Baik')>Baik</option>
                                <option value="Rusak" @selected(request('kondisi') == 'Rusak')>Rusak</option>
                            </select>
                        </div>

                        <!-- Search Box -->
                        <div class="relative flex-1 min-w-[200px] max-w-md ml-auto">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Cari Kode/Nama..."
                                   class="w-full pl-9 pr-3 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        </div>

                        @if(request('search') || request('kategori') || request('kondisi'))
                            <a href="{{ route('items.index') }}" class="text-xs text-blue-600 hover:underline px-2">Reset</a>
                        @endif
                    </form>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-xs sm:text-sm text-gray-700">
                        <thead class="bg-[#f1f5f9] text-gray-600 font-bold uppercase tracking-wider text-[11px] border-y border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3.5">KODE</th>
                                <th scope="col" class="px-6 py-3.5">NAMA BARANG</th>
                                <th scope="col" class="px-6 py-3.5">KATEGORI</th>
                                <th scope="col" class="px-6 py-3.5">STOK</th>
                                <th scope="col" class="px-6 py-3.5">KONDISI</th>
                                <th scope="col" class="px-6 py-3.5">FOTO</th>
                                <th scope="col" class="px-6 py-3.5 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($items as $item)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->kode_barang }}
                                    </td>
                                    <td class="px-6 py-3.5 text-gray-900 whitespace-nowrap font-medium">
                                        {{ $item->nama_barang }}
                                    </td>
                                    <td class="px-6 py-3.5 text-gray-600 whitespace-nowrap">
                                        {{ $item->kategori }}
                                    </td>
                                    <td class="px-6 py-3.5 text-gray-900 font-semibold whitespace-nowrap">
                                        {{ $item->stok }}
                                    </td>
                                    <td class="px-6 py-3.5 whitespace-nowrap">
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
                                    <td class="px-6 py-3.5 whitespace-nowrap">
                                        @if($item->gambar)
                                            <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800 underline">
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3.5 text-center whitespace-nowrap space-x-2">
                                        <!-- Edit Action (Pencil Icon) -->
                                        <a href="{{ route('items.edit', $item) }}"
                                           class="inline-flex p-1.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                           title="Edit Barang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                            </svg>
                                        </a>

                                        <!-- Delete Action (Trash Icon) -->
                                        <form method="POST" action="{{ route('items.destroy', $item) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                    title="Hapus Barang">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">
                                        Belum ada data barang inventaris.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination footer -->
                <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-500">
                    <div>
                        Menampilkan
                        <span class="font-medium text-gray-800">{{ $items->firstItem() ?? 0 }}</span>
                        -
                        <span class="font-medium text-gray-800">{{ $items->lastItem() ?? 0 }}</span>
                        dari
                        <span class="font-medium text-gray-800">{{ $items->total() }}</span>
                        barang
                    </div>

                    <div class="flex items-center gap-1.5 ml-auto">
                        @if($items->onFirstPage())
                            <span class="px-2.5 py-1 text-gray-300 border border-gray-200 rounded bg-gray-50 cursor-not-allowed">&lt;</span>
                        @else
                            <a href="{{ $items->previousPageUrl() }}" class="px-2.5 py-1 text-gray-700 border border-gray-200 rounded hover:bg-gray-100 transition">&lt;</a>
                        @endif

                        <span class="px-3 py-1 font-semibold text-gray-700 border border-gray-200 rounded bg-white">
                            Hal {{ $items->currentPage() }} dari {{ $items->lastPage() }}
                        </span>

                        @if($items->hasMorePages())
                            <a href="{{ $items->nextPageUrl() }}" class="px-2.5 py-1 text-gray-700 border border-gray-200 rounded hover:bg-gray-100 transition">&gt;</a>
                        @else
                            <span class="px-2.5 py-1 text-gray-300 border border-gray-200 rounded bg-gray-50 cursor-not-allowed">&gt;</span>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
