<x-app-layout>
    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

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

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">TOTAL SUPPLIER</p>
                        <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $totalSupplier }} <span class="text-sm font-normal text-gray-500">Mitra</span></p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">SUPPLIER AKTIF</p>
                        <p class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $totalAktif }} <span class="text-sm font-normal text-gray-500">Mitra</span></p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">SUPPLIER TIDAK AKTIF</p>
                        <p class="text-3xl font-extrabold text-slate-500 mt-2">{{ $totalNonaktif }} <span class="text-sm font-normal text-gray-500">Mitra</span></p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="p-6 pb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase tracking-wide">
                            DATA SUPPLIER & PENYEDIA BARANG
                        </h3>
                    </div>

                    <a href="{{ route('suppliers.create') }}"
                       class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#2563eb] hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-lg shadow-sm transition">
                        <span>+ Tambah Supplier Baru</span>
                    </a>
                </div>

                <div class="px-6 pb-5">
                    <form method="GET" action="{{ route('suppliers.index') }}" class="flex flex-wrap items-center gap-3">
                        <div class="relative">
                            <select name="status" onchange="this.form.submit()"
                                    class="text-xs sm:text-sm rounded-lg border-gray-200 bg-gray-50 focus:bg-white text-gray-700 py-2 pl-3 pr-8 shadow-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="Aktif" @selected(request('status') == 'Aktif')>Status: Aktif</option>
                                <option value="Nonaktif" @selected(request('status') == 'Nonaktif')>Status: Nonaktif</option>
                            </select>
                        </div>

                        <div class="relative flex-1 min-w-[200px] max-w-md ml-auto">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="w-full pl-9 pr-3 py-2 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        </div>

                        @if(request('search') || request('status'))
                            <a href="{{ route('suppliers.index') }}" class="text-xs text-blue-600 hover:underline px-2">Reset</a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-xs sm:text-sm text-gray-700">
                        <thead class="bg-[#f1f5f9] text-gray-600 font-bold uppercase tracking-wider text-[11px] border-y border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3.5">KODE </th>
                                <th scope="col" class="px-6 py-3.5">NAMA SUPPLIER</th>
                                <th scope="col" class="px-6 py-3.5">KONTAK/NO HP</th>
                                <th scope="col" class="px-6 py-3.5">ALAMAT</th>
                                <th scope="col" class="px-6 py-3.5 text-center">STATUS</th>
                                <th scope="col" class="px-6 py-3.5 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($suppliers as $supplier)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap">
                                        <span class="font-mono text-xs font-bold text-gray-700 bg-gray-100 px-2.5 py-1 rounded">
                                            {{ $supplier->kode_supplier }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3.5 text-gray-900 whitespace-nowrap font-medium">
                                        {{ $supplier->nama_supplier }}
                                    </td>
                                    <td class="px-6 py-3.5 text-gray-700 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 text-xs text-gray-600">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                            </svg>
                                            {{ $supplier->kontak }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3.5 text-gray-600 max-w-xs truncate" title="{{ $supplier->alamat }}">
                                        {{ $supplier->alamat }}
                                    </td>
                                    <td class="px-6 py-3.5 text-center whitespace-nowrap">
                                        @if($supplier->status === 'Aktif')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3.5 text-center whitespace-nowrap space-x-2">
                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                           class="inline-flex p-1.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                           title="Edit Supplier">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                            </svg>
                                        </a>

                                        <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                                    title="Hapus Supplier">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                        Belum ada data supplier yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($suppliers->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-500">
                        <div>
                            Menampilkan
                            <span class="font-medium text-gray-800">{{ $suppliers->firstItem() ?? 0 }}</span>
                            -
                            <span class="font-medium text-gray-800">{{ $suppliers->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-medium text-gray-800">{{ $suppliers->total() }}</span>
                            supplier
                        </div>

                        <div class="flex items-center gap-1.5 ml-auto">
                            @if($suppliers->onFirstPage())
                                <span class="px-2.5 py-1 text-gray-300 border border-gray-200 rounded bg-gray-50 cursor-not-allowed">&lt;</span>
                            @else
                                <a href="{{ $suppliers->previousPageUrl() }}" class="px-2.5 py-1 text-gray-700 border border-gray-200 rounded hover:bg-gray-100 transition">&lt;</a>
                            @endif

                            <span class="px-3 py-1 font-semibold text-gray-700 border border-gray-200 rounded bg-white">
                                Hal {{ $suppliers->currentPage() }} dari {{ $suppliers->lastPage() }}
                            </span>

                            @if($suppliers->hasMorePages())
                                <a href="{{ $suppliers->nextPageUrl() }}" class="px-2.5 py-1 text-gray-700 border border-gray-200 rounded hover:bg-gray-100 transition">&gt;</a>
                            @else
                                <span class="px-2.5 py-1 text-gray-300 border border-gray-200 rounded bg-gray-50 cursor-not-allowed">&gt;</span>
                            @endif
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
