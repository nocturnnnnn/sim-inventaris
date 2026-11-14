<x-app-layout>
    <h2>Kelola User (Khusus Admin)</h2>
    <p><a href="{{ route('dashboard') }}">Kembali ke Dashboard</a></p>
    <hr>

    @if(session('success'))
        <p style="color: green;"><b>Notifikasi:</b> {{ session('success') }}</p>
        <hr>
    @endif

    @if(session('error'))
        <p style="color: red;"><b>Peringatan:</b> {{ session('error') }}</p>
        <hr>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role Saat Ini</th>
                <th>Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                    <td>
                        <form method="POST" action="{{ route('users.updateRole', $u) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role">
                                <option value="staff" @selected($u->role === 'staff')>staff</option>
                                <option value="admin" @selected($u->role === 'admin')>admin</option>
                            </select>
                            <button type="submit">Simpan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>