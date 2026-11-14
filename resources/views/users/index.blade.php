<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Kelola User (Khusus Admin)</h2>
                    <p class="text-xs text-gray-500 mt-1">Ubah hak akses dan wewenang pengguna sistem.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center gap-1">
                    &larr; Kembali ke Dashboard
                </a>
            </div>

            <!-- Notifikasi Flash -->
            @if(session('success'))
                <div class="p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 flex items-center gap-2 text-sm shadow-sm">
                    <svg class="w-5 h-5 text-green-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span><b>Notifikasi:</b> {{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-2 text-sm shadow-sm">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span><b>Peringatan:</b> {{ session('error') }}</span>
                </div>
            @endif

            <!-- Tabel Daftar User -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role Saat Ini</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ubah Role</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($users as $u)
                                <tr class="hover:bg-gray-50/75 transition">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $u->name }}
                                        @if(auth()->id() === $u->id)
                                            <span class="ml-1.5 text-xs text-gray-500 font-normal">(Akun Anda)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $u->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium uppercase {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $u->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('users.updateRole', $u) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="rounded-lg border-gray-300 text-xs py-1 px-2.5 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="staff" @selected($u->role === 'staff')>staff</option>
                                                <option value="admin" @selected($u->role === 'admin')>admin</option>
                                            </select>
                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg shadow-sm transition">
                                                Simpan
                                            </button>
                                        </form>
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
