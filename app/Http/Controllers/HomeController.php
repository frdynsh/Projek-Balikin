<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman root / 
     * Cek login & role, lalu redirect
     */
    public function index()
    {
        return auth()->check() ? redirect()->route('dashboard') : view('welcome');
    }

    /**
     * Halaman dashboard
     * Cek role, lalu redirect ke dashboard admin jika admin
     */
    public function dashboard()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    }
}
