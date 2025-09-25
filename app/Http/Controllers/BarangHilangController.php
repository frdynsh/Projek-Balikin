<?php

namespace App\Http\Controllers;

use App\Models\BarangHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangHilangController extends Controller
{
    /**
     * Menampilkan daftar barang hilang yang sudah disetujui.
     */
    public function index()
    {
        // Mengambil data dari tabel 'barang_hilangs' yang statusnya 'diterima'
        $barangHilangs = BarangHilang::where('status', 'diterima')->with('user')->latest()->paginate(9);
        
        // Mengarahkan ke view 'lostitems.index'
        return view('lostitems.index', compact('barangHilangs'));
    }

    /**
     * Menampilkan formulir untuk membuat laporan baru.
     */
    public function create()
    {
        // Mengarahkan ke view 'lostitems.create'
        return view('lostitems.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input sesuai dengan kolom di tabel 'barang_hilangs'
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_kehilangan'    => 'required|date',
            'lokasi_kehilangan' => 'required|string|max:255',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Mengelola upload gambar dan menyimpan path-nya
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/barang-hilang');
            $validatedData['gambar'] = $path;
        }

        // 3. Membuat entri baru di tabel 'barang_hilangs'
        //    dan secara otomatis mengisi kolom 'user_id'
        $request->user()->barangHilang()->create($validatedData);

        // 4. Arahkan kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('barang-hilang.index')->with('success', 'Laporan barang hilang berhasil dibuat. Mohon tunggu validasi dari admin.');
    }
}