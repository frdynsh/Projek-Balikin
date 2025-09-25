<?php

namespace App\Http\Controllers;

use App\Models\BarangHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{
    /**
     * Menampilkan daftar semua barang hilang yang sudah disetujui.
     */
    public function index()
    {
        $barangHilangs = BarangHilang::where('status', 'diterima')->with('user')->latest()->paginate(9);
        return view('lost-items.index', compact('barangHilangs'));
    }

    /**
     * Menampilkan formulir untuk membuat laporan baru.
     */
    public function create()
    {
        return view('lost-items.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi, pastikan ada aturan 'image'
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_kehilangan'    => 'required|date',
            'lokasi_kehilangan' => 'required|string|max:255',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ]);

        // 2. Logika untuk menyimpan file jika validasi berhasil
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/barang-hilang');
            $validatedData['gambar'] = $path;
        }

        // 3. Simpan data ke database
        $request->user()->barangHilang()->create($validatedData);

        return redirect()->route('lost-items.index')->with('success', 'Laporan berhasil dibuat. Mohon tunggu validasi admin.');
    }

    /**
     * Menampilkan halaman detail untuk satu barang hilang.
     */
    public function show(BarangHilang $barangHilang)
    {
        // Keamanan: Hanya tampilkan detail jika statusnya 'diterima',
        // atau jika yang melihat adalah admin atau pemilik laporan.
        if ($barangHilang->status !== 'diterima' && (auth()->user()->role !== 'admin' && auth()->id() !== $barangHilang->user_id)) {
            abort(404); // Tampilkan halaman tidak ditemukan
        }
        return view('lost-items.show', ['barangHilang' => $barangHilang]);
    }

    /**
     * Menampilkan formulir untuk mengedit laporan.
     */
    public function edit(BarangHilang $barangHilang)
    {
        // Keamanan: Hanya pemilik laporan atau admin yang bisa mengedit.
        if (auth()->id() !== $barangHilang->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES.');
        }

        return view('lost-items.edit', compact('barangHilang'));
    }

    /**
     * Memproses dan menyimpan perubahan dari form edit.
     */
    public function update(Request $request, BarangHilang $barangHilang)
    {
        // Keamanan: Hanya pemilik laporan atau admin yang bisa mengupdate.
        if (auth()->id() !== $barangHilang->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES.');
        }

        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_kehilangan'    => 'required|date',
            'lokasi_kehilangan' => 'required|string|max:255',
            'gambar'            => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada untuk menghemat ruang penyimpanan
            if ($barangHilang->gambar) {
                Storage::delete($barangHilang->gambar);
            }
            $path = $request->file('gambar')->store('public/barang-hilang');
            $validatedData['gambar'] = $path;
        }
        
        // Aturan bisnis: Setiap kali diedit, status kembali 'menunggu' untuk divalidasi ulang.
        $validatedData['status'] = 'menunggu';
        $barangHilang->update($validatedData);

        return redirect()->route('lost-items.index')->with('success', 'Laporan berhasil diperbarui dan akan divalidasi ulang oleh admin.');
    }

    /**
     * Menghapus laporan dari database.
     */
    public function destroy(BarangHilang $barangHilang)
    {
        // Keamanan: Hanya pemilik laporan atau admin yang bisa menghapus.
        if (auth()->id() !== $barangHilang->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES.');
        }

        // Hapus juga file gambar dari storage
        if ($barangHilang->gambar) {
            Storage::delete($barangHilang->gambar);
        }
        $barangHilang->delete();

        return redirect()->route('lost-items.index')->with('success', 'Laporan berhasil dihapus.');
    }
}

