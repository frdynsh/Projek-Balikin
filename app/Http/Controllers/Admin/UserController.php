<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan halaman daftar semua user.
     * Fungsi ini akan dipanggil saat admin membuka URL /admin/users
     */
    public function index()
    {
        // 2. Ambil semua data user dari database, DENGAN BEBERAPA KONDISI:
        //    - where('id', '!=', auth()->id()): JANGAN ambil data admin yang sedang login
        //                                      agar tidak bisa menghapus diri sendiri.
        //    - latest(): Urutkan hasilnya dari yang paling baru dibuat.
        //    - paginate(10): Batasi data yang tampil hanya 10 per halaman.
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(10);

        // 3. Kirim data users yang sudah diambil ke file view.
        //    File view-nya akan berlokasi di 'resources/views/admin/users/index.blade.php'
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menghapus user dari database.
     * Fungsi ini akan dipanggil saat admin mengklik tombol "Hapus".
     * Laravel secara ajaib akan langsung memberikan data user yang akan dihapus ($user).
     */
    public function destroy(User $user)
    {
        // 4. Hapus data user yang dipilih dari database.
        $user->delete();

        // 5. Kembali ke halaman daftar user (admin.users.index) dengan membawa
        //    pesan sukses yang akan ditampilkan sebagai notifikasi.
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
