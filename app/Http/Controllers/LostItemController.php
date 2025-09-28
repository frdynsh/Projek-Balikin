<?php

namespace App\Http\Controllers;

use App\Models\BarangHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{
    public function index()
    {   
        $search = request('search');

        $query = BarangHilang::where('status', 'diterima');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('deskripsi_barang', 'like', '%' . $search . '%');
            });
        }

        $barangHilangs = $query->latest()->paginate(9);

        return view('lost-items.index', compact('barangHilangs'));
    }

    public function create()
    {
        return view('lost-items.create');
    }

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

    public function show(BarangHilang $lost_item)
    {
        if ($lost_item->status !== 'diterima') {
            abort(404);
        }
        
        $lost_item->load('user');
        return view('lost-items.show', ['barangHilang' => $lost_item]);
    }

    public function edit(BarangHilang $lost_item)
    {
        if (auth()->id() !== $lost_item->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES UNTUK MENGEDIT LAPORAN INI.');
        }

        return view('lost-items.edit', ['barangHilang' => $lost_item]);
    }

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
    public function markAsDone(BarangHilang $lost_item)
    {
        if (auth()->id() !== $lost_item->user_id) {
            abort(403);
        }
        $lost_item->update(['status' => 'selesai']);
        return redirect()->route('lost-items.index')->with('success', 'Laporan telah ditandai sebagai selesai dan diarsipkan.');
    }
    /**
     * Hanya admin yang bisa menghapus.
     */
    public function destroy(BarangHilang $lost_item)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'HANYA ADMIN YANG DAPAT MENGHAPUS LAPORAN INI.');
        }

        if ($lost_item->gambar) { Storage::delete($lost_item->gambar); }
        $lost_item->delete();

        return redirect()->route('lost-items.index')->with('success', 'Laporan berhasil dihapus oleh Admin.');
    }
}

