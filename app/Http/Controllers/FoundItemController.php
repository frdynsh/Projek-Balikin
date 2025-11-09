<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoundItemController extends Controller
{
    /**
     * Menampilkan daftar semua barang temuan yang sudah disetujui.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Barangtemuan::where('status', 'diterima');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi_barang', 'like', '%' . $search . '%');
            });
        }

        $barangTemuans = $query->latest()->paginate(9);
        $barangTemuans->appends(['search' => $search]);

        return view('found-items.index', compact('barangTemuans', 'search'));
    }

    /**
     * Menampilkan formulir untuk membuat laporan baru.
     */
    public function create()
    {
        return view('found-items.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_penemuan'      => 'required|date',
            'lokasi_penemuan'   => 'required|string|max:255',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang-temuan', 'public');
            $validatedData['gambar'] = $path;
        }

        $request->user()->barangTemuan()->create($validatedData);

        return redirect()->route('found-items.index')->with('success', 'Laporan barang temuan berhasil dibuat. Mohon tunggu validasi admin.');
    }

    /**
     * Menampilkan halaman detail untuk satu barang temuan.
     */
    public function show(BarangTemuan $found_item)
    {
        if ($found_item->status !== 'diterima') {
            abort(404);
        }
        
        $found_item->load('user');
        return view('found-items.show', ['barangTemuan' => $found_item]);
    }

    /**
     * Menampilkan formulir untuk mengedit laporan.
     */
    public function edit(BarangTemuan $found_item)
    {
        if (auth()->id() !== $found_item->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES UNTUK MENGEDIT LAPORAN INI.');
        }

        return view('found-items.edit', ['barangTemuan' => $found_item]);
    }

    /**
     * Memproses dan menyimpan perubahan dari form edit.
     */
    public function update(Request $request, BarangTemuan $found_item)
    {
        if (auth()->id() !== $found_item->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES UNTUK MENGEDIT LAPORAN INI.');
        }

        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_penemuan'      => 'required|date',
            'lokasi_penemuan'   => 'required|string|max:255',
            'gambar'            => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        if ($request->hasFile('gambar')) {
            if ($found_item->gambar) { Storage::delete($found_item->gambar); }
            $path = $request->file('gambar')->store('barang-temuan', 'public');
            $validatedData['gambar'] = $path;
        }
        
        $validatedData['status'] = 'menunggu';
        $found_item->update($validatedData);

        return redirect()->route('found-items.index')->with('success', 'Laporan berhasil diperbarui dan akan divalidasi ulang.');
    }
    public function markAsDone(BarangTemuan $found_item)
    {
        if (auth()->id() !== $found_item->user_id) {
            abort(403);
        }
        $found_item->update(['status' => 'selesai']);
        return redirect()->route('found-items.index')->with('success', 'Laporan telah ditandai sebagai selesai dan diarsipkan.');
    }
    /**
     * Menghapus laporan dari database.
     */
    public function destroy(BarangTemuan $found_item)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'HANYA ADMIN YANG DAPAT MENGHAPUS LAPORAN INI.');
        }

        if ($found_item->gambar) { Storage::delete($found_item->gambar); }
        $found_item->delete();

        return redirect()->route('found-items.index')->with('success', 'Laporan berhasil dihapus oleh Admin.');
    }
}

