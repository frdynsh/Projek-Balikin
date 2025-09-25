<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoundItemController extends Controller
{
    public function index()
    {
        $barangTemuans = BarangTemuan::orderBy('created_at', 'desc')->paginate(10);
        return view('barang-temuan.index', compact('barangTemuans'));
    }


    public function create()
    {
        return view('barang-temuan.create');
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
            $path = $request->file('gambar')->store('public/barang-temuan');
            $validatedData['gambar'] = $path;
        }

        $request->user()->barangTemuan()->create($validatedData);

        return redirect()->route('barang-temuan.index')->with('success', 'Laporan barang temuan berhasil dibuat. Mohon tunggu validasi dari admin.');
    }
}