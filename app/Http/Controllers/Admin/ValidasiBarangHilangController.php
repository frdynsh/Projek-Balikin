<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangHilang;
use App\Exports\BarangHilangExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

class ValidasiBarangHilangController extends Controller
{
    /**
     * Menampilkan halaman ARSIP (laporan yang sudah ditangani).
     */
    public function index()
    {
        // Ambil hanya barang yang statusnya BUKAN 'pending'
        $barangHilangSelesai = BarangHilang::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get();
            
        return view('admin.validasi.lost-items.index', compact('barangHilangSelesai'));
    }

    /**
     * Menampilkan halaman VALIDASI (laporan yang masih 'pending').
     */
    public function pending()
    {
        // Ambil hanya barang yang statusnya 'menunggu'
        $barangHilangPending = BarangHilang::with('user')
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        return view('admin.validasi.lost-items.pending', compact('barangHilangPending'));
    }

    /**
     * Setujui laporan barang hilang.
     */
    public function setujui(BarangHilang $lost_item)
    {
        $lost_item->update(['status' => 'diterima']);
        // Redirect kembali ke halaman pending
        return redirect()->route('admin.validasi.lost-items.pending')->with('success', 'Laporan barang hilang telah disetujui.');
    }

    /**
     * Tolak laporan barang hilang.
     */
    public function tolak(BarangHilang $lost_item)
    {
        $lost_item->update(['status' => 'ditolak']);
        // Redirect kembali ke halaman pending
        return redirect()->route('admin.validasi.lost-items.pending')->with('success', 'Laporan barang hilang telah ditolak.');
    }
    
    /**
     * Hapus permanen laporan barang hilang dari arsip admin.
     */
    public function destroy(BarangHilang $lost_item)
    {
        // Hapus file gambar jika ada
        if ($lost_item->gambar) {
            Storage::disk('public')->delete($lost_item->gambar);
        }

        $lost_item->delete();

        // Redirect kembali ke halaman ARSIP ADMIN
        return redirect()->route('admin.validasi.lost-items.index')->with('success', 'Laporan telah dihapus permanen.');
    }

    /**
     * Export Arsip ke Excel menggunakan Maatwebsite Excel
     */
    public function exportExcel()
    {
        return Excel::download(new BarangHilangExport, 'arsip_barang_hilang.xlsx');
    }

    /**
     * Export PDF menggunakan Spatie Browsershot
     */
    public function exportPdf()
    {
        $barangHilangSelesai = BarangHilang::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get();

        // Render view menjadi HTML
        $html = view('admin.validasi.lost-items.pdf', compact('barangHilangSelesai'))->render();

        // Tentukan path sementara file PDF
        $filePath = storage_path('app/public/arsip_barang_hilang.pdf');

        // Generate PDF dengan Browsershot dan simpan
        Browsershot::html($html)
            ->showBackground()
            ->format('A4')
            ->landscape()
            ->save($filePath);

        // Return file download menggunakan Laravel Response
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}