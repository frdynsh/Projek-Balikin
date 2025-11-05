<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangHilang;
use App\Models\BarangTemuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data statistik.
     */
    public function __invoke(Request $request): View
    {
        // 1. Statistik untuk Kartu
        $totalLaporanHilang = BarangHilang::count();
        $totalLaporanTemuan = BarangTemuan::count();
        $laporanPerluValidasi = BarangHilang::where('status', 'menunggu')->count()
                              + BarangTemuan::where('status', 'menunggu')->count();
        $totalPengguna = User::count();

        // 2. Data untuk Aktivitas Terbaru
        $aktivitasHilang = BarangHilang::latest()->get();
        $aktivitasTemuan = BarangTemuan::latest()->get();

        $aktivitasTerbaru = $aktivitasHilang->merge($aktivitasTemuan)
                                            ->sortByDesc('created_at')
                                            ->take(5);

        // 3. Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalLaporanHilang',
            'totalLaporanTemuan',
            'laporanPerluValidasi',
            'totalPengguna',
            'aktivitasTerbaru'
        ));
    }
}