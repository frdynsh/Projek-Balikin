<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangTemuan;
use App\Exports\BarangTemuanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

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
        // Ambil hanya barang yang statusnya 'menunggu'
        $barangTemuanPending = BarangTemuan::with('user')
            ->where('status', 'menunggu')
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

    /**
     * Hapus permanen laporan barang temuan dari arsip admin.
     */
    public function destroy(BarangTemuan $found_item)
    {
        // Hapus file gambar jika ada
        if ($found_item->gambar) {
            Storage::disk('public')->delete($found_item->gambar);
        }

        // Hapus data dari database
        $found_item->delete();

        // Redirect kembali ke halaman ARSIP ADMIN
        return redirect()->route('admin.validasi.found-items.index')
            ->with('success', 'Laporan barang temuan telah dihapus permanen.');
    }
    
    /**
     * Export Arsip ke Excel menggunakan Maatwebsite Excel
     */
    public function exportExcel()
    {
        return Excel::download(new BarangTemuanExport, 'arsip_barang_temuan.xlsx');
    }

    /**
     * Export PDF menggunakan Spatie Browsershot
     */
    public function exportPdf()
    {
        $barangTemuanSelesai = BarangTemuan::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get();

        // Render view menjadi HTML
        $html = view('admin.validasi.found-items.pdf', compact('barangTemuanSelesai'))->render();

        // Tentukan path sementara file PDF
        $filePath = storage_path('app/public/arsip_barang_temuan.pdf');

        // Generate PDF dengan Browsershot dan simpan
        \Spatie\Browsershot\Browsershot::html($html)
            ->showBackground()
            ->format('A4')
            ->landscape()
            ->save($filePath);

        // Return file download menggunakan Laravel Response
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}