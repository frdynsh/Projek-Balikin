<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoundItemController extends Controller
{
    /**
     * Menampilkan semua daftar barang temuan yang sudah disetujui admin.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'latest'); 

        $query = BarangTemuan::where('status', 'diterima');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('deskripsi_barang', 'like', '%' . $search . '%');
            });
        }

        // Logika sorting
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'az':
                $query->orderBy('nama_barang', 'asc');
                break;
            case 'za':
                $query->orderBy('nama_barang', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $barangTemuans = $query->paginate(3)->withQueryString(); // otomatis mempertahankan query search & sort

        return view('found-items.index', compact('barangTemuans', 'search', 'sort'));
    }

    /**
     * Menampilkan formulir untuk membuat laporan baru.
     */
    public function create()
    {
        $user = auth()->user();

        if (!$user->nomor_telepon) {
            return redirect()->route('profile.edit')
                ->with('error', 'Harap lengkapi nomor telepon Anda sebelum membuat laporan barang temuan.');
        }
        
        return view('found-items.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_penemuan'      => 'required|date',
            'lokasi_penemuan'   => 'required|string|max:255',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang-temuan', 'public');
            $validatedData['gambar'] = $path;
        }

        // Simpan laporan 
        $request->user()->barangTemuan()->create($validatedData);

        return redirect()->route('found-items.index')->with('success', 'Laporan barang temuan berhasil dibuat. Mohon tunggu validasi admin.');
    }

    /**
     * Menampilkan halaman detail untuk satu barang temuan yang statusnya diterima.
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
     * Menampilkan form edit laporan, hanya dapat dilakukan oleh pemilik laporan.
     */
    public function edit(BarangTemuan $found_item)
    {
        if (auth()->id() !== $found_item->user_id) {
            abort(403, 'ANDA TIDAK PUNYA HAK AKSES UNTUK MENGEDIT LAPORAN INI.');
        }

        return view('found-items.edit', ['barangTemuan' => $found_item]);
    }

    /**
     * Memproses pembaruan laporan dan mengatur status kembali ke ‘menunggu’.
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

    /**
     * Menandai laporan sebagai selesai (diarsipkan), hanya bisa dilakukan oleh pemilik laporan.
     */
    public function markAsDone(BarangTemuan $found_item)
    {
        if (auth()->id() !== $found_item->user_id) {
            abort(403);
        }
        $found_item->update(['status' => 'selesai']);
        return redirect()->route('found-items.index')->with('success', 'Laporan telah ditandai sebagai selesai dan diarsipkan.');
    }
}

