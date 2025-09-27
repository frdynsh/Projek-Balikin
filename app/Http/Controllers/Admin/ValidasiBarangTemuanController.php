<?php

namespace App\Http\Controllers\Admin;

use App\Models\BarangTemuan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValidasiBarangTemuanController extends Controller
{
     /**
     * Menampilkan halaman validasi dan arsip untuk barang temuan.
     */
    public function index()
    {
        $barangTemuanPending = BarangTemuan::with('user')
                                       ->where('status', 'menunggu') 
                                       ->latest()
                                       ->get();

        $barangTemuanSelesai = BarangTemuan::with('user')
                                        ->whereIn('status', ['diterima', 'ditolak', 'selesai'])
                                        ->latest()
                                        ->get();

        return view('admin.validasi.found-items.index', compact('barangTemuanPending', 'barangTemuanSelesai'));
    }

    /**
     * Menyetujui sebuah laporan barang temuan.
     */
    public function setujui(BarangTemuan $foundItem)
    {
        $foundItem->update(['status' => 'diterima']);
        return back()->with('success', 'Laporan barang temuan telah disetujui.');
    }

    /**
     * Menolak sebuah laporan barang temuan.
     */
    public function tolak(BarangTemuan $foundItem)
    {
        $foundItem->update(['status' => 'ditolak']);
        return back()->with('success', 'Laporan barang temuan telah ditolak.');
    }
}
