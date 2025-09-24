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
     * FUNGSI BARU: Menampilkan formulir untuk mengedit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * FUNGSI BARU: Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'in:admin,user'],
            'nim' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nip' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'nomor_telepon' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password tidak wajib diisi
        ]);

        $userData = $request->only('name', 'email', 'role', 'nim', 'nip', 'jurusan', 'nomor_telepon');

        // Hanya update password jika kolomnya diisi
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
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
