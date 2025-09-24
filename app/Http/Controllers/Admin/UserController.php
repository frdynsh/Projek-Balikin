<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan halaman daftar semua user.
     * Fungsi ini akan dipanggil saat admin membuka URL /admin/users
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * FUNGSI BARU: Menampilkan formulir untuk membuat user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * FUNGSI BARU: Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari formulir
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'], // Memastikan role yang dipilih valid
        ]);

        // 2. Buat user baru di database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // 3. Kembali ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
