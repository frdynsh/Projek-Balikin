<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangTemuan;
use Illuminate\Http\Request;

class ValidasiBarangTemuanController extends Controller
{
    /**
     * Menampilkan halaman ARSIP (laporan yang sudah ditangani).
     */
    public function index()
    {
        // Ambil hanya barang yang statusnya BUKAN 'pending'
        $barangTemuanSelesai = BarangTemuan::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get();

        return view('admin.validasi.found-items.index', compact('barangTemuanSelesai'));
    }

    /**
     * Menampilkan halaman VALIDASI (laporan yang masih 'pending').
     */
    public function pending()
    {
        // Ambil hanya barang yang statusnya 'pending'
        $barangTemuanPending = BarangTemuan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.validasi.found-items.pending', compact('barangTemuanPending'));
    }

    /**
     * Setujui laporan barang temuan.
     */
    public function setujui(BarangTemuan $found_item)
    {
        $found_item->update(['status' => 'diterima']);
        return redirect()->route('admin.validasi.found-items.pending')->with('success', 'Laporan barang temuan telah disetujui.');
    }

    /**
     * Tolak laporan barang temuan.
     */
    public function tolak(BarangTemuan $found_item)
    {
        $found_item->update(['status' => 'ditolak']);
        return redirect()->route('admin.validasi.found-items.pending')->with('success', 'Laporan barang temuan telah ditolak.');
    }
}