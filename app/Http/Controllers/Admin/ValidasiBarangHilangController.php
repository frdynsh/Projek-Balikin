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
        $barangHilangPending = BarangHilang::with('user')
                                ->where('status', 'menunggu') 
                                ->latest()
                                ->get();

        $barangHilangSelesai = BarangHilang::with('user')
                                        ->whereIn('status', ['diterima', 'ditolak', 'selesai'])
                                        ->latest()
                                        ->get();

        return view('admin.validasi.lost-items.index', compact('barangHilangPending', 'barangHilangSelesai'));
    }

    /**
     * Menyetujui sebuah laporan barang hilang.
     */
    public function setujui(BarangHilang $lostItem)
    {
        $lostItem->update(['status' => 'diterima']);
        return back()->with('success', 'Laporan barang hilang telah disetujui.');
    }

    /**
     * Menolak sebuah laporan barang hilang.
     */
    public function tolak(BarangHilang $lostItem)
    {
        $lostItem->update(['status' => 'ditolak']);
        return back()->with('success', 'Laporan barang hilang telah ditolak.');
    }
}
