<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,staff',
        ]);

        if (auth()->id() === $user->id && $request->role !== 'admin') {
            return back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri!');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role pengguna '.$user->name.' berhasil diperbarui menjadi '.strtoupper($request->role).'!');
    }
}
