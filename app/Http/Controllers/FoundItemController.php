<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// NAMA CLASS DISESUAIKAN
class FoundItemController extends Controller
{
    public function index()
    {
        $barangTemuans = BarangTemuan::where('status', 'diterima')->with('user')->latest()->paginate(9);
        return view('found-items.index', compact('barangTemuans'));
    }

    public function create()
    {
        return view('found-items.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang'       => 'required|string|max:255',
            'deskripsi_barang'  => 'required|string',
            'tgl_penemuan'      => 'required|date',
            'lokasi_penemuan'   => 'required|string|max:255',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/found-items');
            $validatedData['gambar'] = $path;
        }

        $request->user()->barangTemuan()->create($validatedData);

        return redirect()->route('found-items.index')->with('success', 'Laporan barang temuan berhasil dibuat. Mohon tunggu validasi dari admin.');
    }
}