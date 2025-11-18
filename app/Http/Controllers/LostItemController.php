<?php

namespace App\Http\Controllers;

use App\Models\BarangHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{   
    /**
     * Menampilkan semua daftar barang hilang yang sudah disetujui admin.
     */
    public function index(Request $request)
    {   
        $search = $request->input('search');

        $query = BarangHilang::where('status', 'diterima');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('deskripsi_barang', 'like', '%' . $search . '%');
            });
        }

        $barangHilangs = $query->latest()->paginate(9);
        $barangHilangs->appends(['search' => $search]);
        return view('lost-items.index', compact('barangHilangs', 'search'));
    }

    /**
     * Menampilkan form untuk membuat laporan barang hilang baru.
     */
    public function create()
    {
        return view('lost-items.create');
    }

    /**
     * Menyimpan laporan barang hilang ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_kehilangan'    => 'required|date',
            'lokasi_kehilangan' => 'required|string|max:255',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang-hilang', 'public');
            $validatedData['gambar'] = $path;
        }

        $request->user()->barangHilang()->create($validatedData);

        return redirect()->route('lost-items.index')->with('success', 'Laporan berhasil dibuat. Mohon tunggu validasi admin.');
    }

    /**
     * Menampilkan halaman detail untuk satu barang hilang yang statusnya diterima.
     */
    public function show(BarangHilang $lost_item)
    {
        if ($lost_item->status !== 'diterima') {
            abort(404);
        }
        
        $lost_item->load('user');
        return view('lost-items.show', ['barangHilang' => $lost_item]);
    }

    /**
     * Menampilkan form edit laporan, hanya dapat dilakukan oleh pemilik laporan.
     */
    public function edit(BarangHilang $lost_item)
    {
        if (auth()->id() !== $lost_item->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES UNTUK MENGEDIT LAPORAN INI.');
        }

        return view('lost-items.edit', ['barangHilang' => $lost_item]);
    }

    /**
     * Memproses pembaruan laporan dan mengatur status kembali ke ‘menunggu’.
     */
    public function update(Request $request, BarangHilang $lost_item)
    {
        if (auth()->id() !== $lost_item->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES UNTUK MENGEDIT LAPORAN INI.');
        }

        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_kehilangan'    => 'required|date',
            'lokasi_kehilangan' => 'required|string|max:255',
            'gambar'            => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        if ($request->hasFile('gambar')) {
            if ($lost_item->gambar) { Storage::delete($lost_item->gambar); }
            $path = $request->file('gambar')->store('barang-hilang', 'public');
            $validatedData['gambar'] = $path;
        }
        
        $validatedData['status'] = 'menunggu';
        $lost_item->update($validatedData);

        return redirect()->route('lost-items.index')->with('success', 'Laporan berhasil diperbarui dan akan divalidasi ulang.');
    }

    /**
     * Menandai laporan sebagai selesai (diarsipkan), hanya bisa dilakukan oleh pemilik laporan.
     */
    public function markAsDone(BarangHilang $lost_item)
    {
        if (auth()->id() !== $lost_item->user_id) {
            abort(403);
        }
        $lost_item->update(['status' => 'selesai']);
        return redirect()->route('lost-items.index')->with('success', 'Laporan telah ditandai sebagai selesai dan diarsipkan.');
    }
}

