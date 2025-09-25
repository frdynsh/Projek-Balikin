<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangTemuan;

class FoundItemController extends Controller
{
    public function index()
    {
        $items = BarangTemuan::all();
        return view('barang_temuan.index', compact('items'));
    }

    public function create()
    {
        return view('barang_temuan.create');
    }

    public function store(Request $request)
    {
        // simpan data barang temuan
    }

    public function show(BarangTemuan $barangTemuan)
    {
        return view('barang_temuan.show', compact('barangTemuan'));
    }
}
