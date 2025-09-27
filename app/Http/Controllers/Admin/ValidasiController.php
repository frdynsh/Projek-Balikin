<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BarangHilang;
use App\Models\BarangTemuan;

class ValidasiController extends Controller
{
    /**
     * Menampilkan halaman utama validasi dengan semua laporan yang 'menunggu'.
     */
    public function index()
    {
        $barangHilangPending = BarangHilang::where('status', 'menunggu')->with('user')->latest()->get();
        $barangTemuanPending = BarangTemuan::where('status', 'menunggu')->with('user')->latest()->get();
        $barangHilangSelesai = BarangHilang::where('status', 'selesai')->with('user')->latest()->get();
        $barangTemuanSelesai = BarangTemuan::where('status', 'selesai')->with('user')->latest()->get();

        return view('admin.validasi.index', compact(
            'barangHilangPending', 
            'barangTemuanPending',
            'barangHilangSelesai',
            'barangTemuanSelesai'
        ));
    }

    // --- Aksi untuk Barang Hilang ---
    public function setujuiBarangHilang(BarangHilang $barangHilang)
    {
        $barangHilang->update(['status' => 'diterima']);
        return back()->with('success', 'Laporan barang hilang telah disetujui.');
    }

    public function tolakBarangHilang(BarangHilang $barangHilang)
    {
        $barangHilang->update(['status' => 'ditolak']);
        return back()->with('success', 'Laporan barang hilang telah ditolak.');
    }

    // --- Aksi untuk Barang Temuan ---
    public function setujuiBarangTemuan(BarangTemuan $barangTemuan)
    {
        $barangTemuan->update(['status' => 'diterima']);
        return back()->with('success', 'Laporan barang temuan telah disetujui.');
    }

    public function tolakBarangTemuan(BarangTemuan $barangTemuan)
    {
        $barangTemuan->update(['status' => 'ditolak']);
        return back()->with('success', 'Laporan barang temuan telah ditolak.');
    }
}