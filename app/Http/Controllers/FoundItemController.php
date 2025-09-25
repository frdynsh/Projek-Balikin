<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangTemuan;

class FoundItemController extends Controller
{
    /**
     * Menampilkan semua barang temuan.
     */
    public function index()
    {
        $items = BarangTemuan::latest()->get();
        return view('barang_temuan.index', compact('items'));
    }

    /**
     * Form tambah barang temuan.
     */
    public function create()
    {
        return view('barang_temuan.create');
    }

    /**
     * Simpan barang temuan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'nullable|string',
            'tgl_penemuan' => 'required|date',
            'lokasi_penemuan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('uploads', 'public');
        }

        BarangTemuan::create($validated);

        return redirect()->route('barang_temuan.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail barang temuan.
     */
    public function show(BarangTemuan $barangTemuan)
    {
        return view('barang_temuan.show', compact('barangTemuan'));
    }

    /**
     * Form edit barang temuan.
     */
    public function edit(BarangTemuan $barangTemuan)
    {
        return view('barang_temuan.edit', compact('barangTemuan'));
    }
}
