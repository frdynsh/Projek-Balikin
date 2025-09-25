<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\LostItemController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ValidasiController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return view('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('lost-items', LostItemController::class)->names('lost-items');
    Route::resource('found-items', FoundItemController::class)->names('found-items');
});

// --- GRUP ROUTE KHUSUS UNTUK ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route Manajemen User
    Route::resource('users', UserController::class);

    // --- ROUTE BARU UNTUK VALIDASI LAPORAN ---
    Route::get('/validasi', [ValidasiController::class, 'index'])->name('validasi.index');
    Route::patch('/validasi/barang-hilang/{barangHilang}/setujui', [ValidasiController::class, 'setujuiBarangHilang'])->name('validasi.hilang.setujui');
    Route::patch('/validasi/barang-hilang/{barangHilang}/tolak', [ValidasiController::class, 'tolakBarangHilang'])->name('validasi.hilang.tolak');
    Route::patch('/validasi/barang-temuan/{barangTemuan}/setujui', [ValidasiController::class, 'setujuiBarangTemuan'])->name('validasi.temuan.setujui');
    Route::patch('/validasi/barang-temuan/{barangTemuan}/tolak', [ValidasiController::class, 'tolakBarangTemuan'])->name('validasi.temuan.tolak');
});


require __DIR__.'/auth.php';
