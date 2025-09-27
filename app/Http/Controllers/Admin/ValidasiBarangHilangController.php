<?php

namespace App\Http\Controllers\Admin;

use App\Models\BarangHilang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValidasiBarangHilangController extends Controller
{
    /**
     * Menampilkan halaman validasi dan arsip untuk barang hilang.
     */
    public function index()
    {
        $barangHilangPending = BarangHilang::where('status', 'menunggu')->with('user')->latest()->get();
        $barangHilangSelesai = BarangHilang::where('status', 'selesai')->with('user')->latest()->get();

        return view('admin.validasi.lost-items.index', compact('barangHilangPending', 'barangHilangSelesai'));
    }

    /**
     * Menyetujui sebuah laporan barang hilang.
     */
    public function setujui(BarangHilang $barangHilang)
    {
        $barangHilang->update(['status' => 'diterima']);
        return back()->with('success', 'Laporan barang hilang telah disetujui.');
    }

    /**
     * Menolak sebuah laporan barang hilang.
     */
    public function tolak(BarangHilang $barangHilang)
    {
        $barangHilang->update(['status' => 'ditolak']);
        return back()->with('success', 'Laporan barang hilang telah ditolak.');
    }
}
