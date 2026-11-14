<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIM INVENTARIS KAMPUS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-800 h-full overflow-x-hidden" x-data="{ sidebarOpen: false, helpOpen: false }">
        <div class="min-h-screen flex bg-[#f8fafc]">

            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" x-cloak
                 x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false"
                 class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden">
            </div>

            <!-- Left Sidebar (Dark Navy Slate) -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 z-50 w-64 bg-[#141e30] text-slate-300 flex flex-col transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:z-auto shrink-0 shadow-xl lg:shadow-none border-r border-slate-800">

                <!-- Logo & Brand Title -->
                <div class="p-6 border-b border-slate-800/80 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full border border-slate-600 bg-slate-800/60 flex items-center justify-center text-white shrink-0 shadow-inner">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.33a2.25 2.25 0 00-.986-1.854L12 4.417 4.486 8.476A2.25 2.25 0 003.5 10.33V21h17z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xs font-bold uppercase tracking-wider text-white leading-tight">SIM INVENTARIS</h1>
                        <p class="text-xs font-semibold text-slate-400 tracking-wider">KAMPUS</p>
                    </div>
                </div>

                <!-- Navigation List -->
                <div class="flex-1 px-4 py-6 overflow-y-auto space-y-6">
                    <div>
                        <p class="px-3 text-[11px] font-semibold text-slate-400 uppercase tracking-widest mb-2.5">NAVIGASI</p>
                        <nav class="space-y-1.5">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}"
                               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-[#1e2e4a] text-white shadow-sm border border-indigo-500/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                                <span class="w-5 h-5 flex items-center justify-center {{ request()->routeIs('dashboard') ? 'text-indigo-400' : 'text-slate-400' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="7" height="7" x="3" y="3" rx="1"/>
                                        <rect width="7" height="7" x="14" y="3" rx="1"/>
                                        <rect width="7" height="7" x="14" y="14" rx="1"/>
                                        <rect width="7" height="7" x="3" y="14" rx="1"/>
                                    </svg>
                                </span>
                                <span>Dashboard</span>
                            </a>

                            <!-- Data Barang -->
                            <a href="{{ route('items.index') }}"
                               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('items.*') ? 'bg-[#1e2e4a] text-white shadow-sm border border-indigo-500/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                                <span class="w-5 h-5 flex items-center justify-center {{ request()->routeIs('items.*') ? 'text-indigo-400' : 'text-slate-400' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                    </svg>
                                </span>
                                <span>Data Barang</span>
                            </a>

                            <!-- Kategori -->
                            <a href="{{ route('categories.index') }}"
                               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('categories.*') ? 'bg-[#1e2e4a] text-white shadow-sm border border-indigo-500/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                                <span class="w-5 h-5 flex items-center justify-center {{ request()->routeIs('categories.*') ? 'text-indigo-400' : 'text-slate-400' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.386a3.75 3.75 0 001.378-1.378c.486-.827.313-1.908-.386-2.607L7.257 7.568A2.25 2.25 0 016.666 5.977V3z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                                    </svg>
                                </span>
                                <span>Kategori</span>
                            </a>

                            <!-- Kelola User (Admin Khusus) -->
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('users.index') }}"
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('users.*') ? 'bg-[#1e2e4a] text-white shadow-sm border border-indigo-500/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                                    <span class="w-5 h-5 flex items-center justify-center {{ request()->routeIs('users.*') ? 'text-indigo-400' : 'text-slate-400' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                        </svg>
                                    </span>
                                    <span>Kelola User</span>
                                </a>
                            @endif

                            <!-- Laporan -->
                            <a href="{{ route('reports.index') }}"
                               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('reports.*') ? 'bg-[#1e2e4a] text-white shadow-sm border border-indigo-500/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                                <span class="w-5 h-5 flex items-center justify-center {{ request()->routeIs('reports.*') ? 'text-indigo-400' : 'text-slate-400' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </span>
                                <span>Laporan</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Bottom Sidebar Links (Bantuan & Keluar) -->
                <div class="p-4 border-t border-slate-800 space-y-1.5 bg-[#101826]">
                    <!-- Bantuan -->
                    <button type="button" @click="helpOpen = true"
                            class="w-full flex items-center gap-3 px-3.5 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                        <span class="w-5 h-5 flex items-center justify-center text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M12 18h.008v.008H12V18z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        <span>Bantuan</span>
                    </button>

                    <!-- Keluar -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3.5 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-rose-400 hover:bg-slate-800/60 transition">
                            <span class="w-5 h-5 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                </svg>
                            </span>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

                <!-- Top Header Bar (Search & User Dropdown) -->
                <header class="bg-white border-b border-gray-200 sticky top-0 z-30 px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    <!-- Mobile Hamburger & Global Search -->
                    <div class="flex items-center gap-3">
                        <button type="button" @click="sidebarOpen = !sidebarOpen"
                                class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <!-- Search Bar -->
                        <form method="GET" action="{{ route('items.index') }}" class="relative w-48 sm:w-72">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Pencarian..."
                                   class="w-full pl-9 pr-3 py-1.5 text-xs sm:text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        </form>
                    </div>

                    <!-- User Profile Dropdown Pill -->
                    <div class="relative" x-data="{ profileOpen: false }" @click.outside="profileOpen = false">
                        <button type="button" @click="profileOpen = !profileOpen"
                                class="flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-50 transition text-sm">
                            <span class="w-7 h-7 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center uppercase shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="font-medium text-gray-800 text-xs sm:text-sm">{{ auth()->user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-gray-500 transition-transform duration-150" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg border border-gray-100 py-1.5 z-50 text-sm">
                            <div class="px-4 py-2 border-b border-gray-100 text-xs text-gray-500">
                                Role: <span class="font-semibold uppercase text-indigo-600">{{ auth()->user()->role }}</span>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                Pengaturan Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-rose-600 hover:bg-rose-50 transition">
                                    Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>

        </div>

        <!-- Bantuan Modal Reactive -->
        <div x-show="helpOpen" x-cloak
             class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="helpOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     @click="helpOpen = false" class="fixed inset-0 transition-opacity bg-slate-900/60"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div x-show="helpOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span class="text-xl">💡</span> Panduan & Bantuan Sistem
                        </h3>
                        <button type="button" @click="helpOpen = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="mt-4 space-y-3 text-sm text-gray-600">
                        <p><b>SIM INVENTARIS KAMPUS</b> membantu pengelolaan sarana & prasarana institusi secara terpadu:</p>
                        <ul class="list-disc pl-5 space-y-1.5 text-xs text-gray-600">
                            <li><b>Dashboard:</b> Ringkasan jumlah item, stok fisik total, dan barang rusak.</li>
                            <li><b>Data Barang:</b> CRUD lengkap inventaris, filter kategori & kondisi, serta upload foto barang.</li>
                            <li><b>Laporan:</b> Cetak rekapitulasi data fisik inventaris per kategori untuk administrasi kampus.</li>
                            <li><b>Kelola User:</b> Khusus administrator untuk mengatur peran Staf dan Admin.</li>
                        </ul>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button type="button" @click="helpOpen = false"
                                class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
