<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\BarangHilangController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ValidasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('barang-temuan', FoundItemController::class)->names('barang-temuan');
    Route::resource('lostitems', BarangHilangController::class)->names('lostitems');
});

// --- GRUP ROUTE KHUSUS UNTUK ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // --- ROUTE UNTUK MANAJEMEN USER ---
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // --- ROUTE BARU UNTUK VALIDASI LAPORAN ---
    Route::get('/validasi', [ValidasiController::class, 'index'])->name('validasi.index');
    Route::patch('/validasi/barang-hilang/{barangHilang}/setujui', [ValidasiController::class, 'setujuiBarangHilang'])->name('validasi.hilang.setujui');
    Route::patch('/validasi/barang-hilang/{barangHilang}/tolak', [ValidasiController::class, 'tolakBarangHilang'])->name('validasi.hilang.tolak');
    Route::patch('/validasi/barang-temuan/{barangTemuan}/setujui', [ValidasiController::class, 'setujuiBarangTemuan'])->name('validasi.temuan.setujui');
    Route::patch('/validasi/barang-temuan/{barangTemuan}/tolak', [ValidasiController::class, 'tolakBarangTemuan'])->name('validasi.temuan.tolak');
});


require __DIR__.'/auth.php';
