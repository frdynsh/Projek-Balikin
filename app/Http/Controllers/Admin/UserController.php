<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
     * FUNGSI Menampilkan formulir untuk membuat user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * FUNGSI Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'],
            'nim' => ['nullable', 'string', 'max:255', 'unique:'.User::class],
            'nip' => ['nullable', 'string', 'max:255', 'unique:'.User::class],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'nomor_telepon' => ['nullable', 'string', 'max:255'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nim' => $request->nim,
            'nip' => $request->nip,
            'jurusan' => $request->jurusan,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * FUNGSI Menampilkan formulir untuk mengedit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * FUNGSI Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => ['required', 'string', Rule::in(['user', 'admin'])],
        ]);

        if ($request->role === $user->role) {
            return redirect()->route('admin.users.edit', $user)->with('warning', 'Tidak ada perubahan yang terdeteksi untuk diperbarui.');
        }

        $user->update([
            'role' => $validatedData['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Role pengguna ' . $user->name . ' berhasil diperbarui dari ' . $user->role . ' menjadi ' . $validatedData['role'] . '.');
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
