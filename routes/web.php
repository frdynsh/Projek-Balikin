<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\LostItemController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ValidasiBarangHilangController;
use App\Http\Controllers\Admin\ValidasiBarangTemuanController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('lost-items', LostItemController::class)->names('lost-items');
    Route::patch('lost-items/{lost_item}/mark-as-done', [\App\Http\Controllers\LostItemController::class, 'markAsDone'])->name('lost-items.markAsDone');
    
    Route::resource('found-items', FoundItemController::class)->names('found-items');
    Route::patch('found-items/{found_item}/mark-as-done', [\App\Http\Controllers\FoundItemController::class, 'markAsDone'])->name('found-items.markAsDone');
});

// --- GRUP ROUTE KHUSUS UNTUK ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Route dashboard admin
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Route Manajemen User
    Route::resource('users', UserController::class);

    // Rute untuk halaman validasi barang hilang
    Route::get('/validasi/lost-items/pending', [ValidasiBarangHilangController::class, 'pending'])->name('validasi.lost-items.pending');
    Route::get('/validasi/lost-items', [ValidasiBarangHilangController::class, 'index'])->name('validasi.lost-items.index');
    Route::patch('/validasi/lost-items/{lost_item}/setujui', [ValidasiBarangHilangController::class, 'setujui'])->name('validasi.lost-items.setujui');
    Route::patch('/validasi/lost-items/{lost_item}/tolak', [ValidasiBarangHilangController::class, 'tolak'])->name('validasi.lost-items.tolak');
    Route::delete('/validasi/lost-items/{lost_item}', [ValidasiBarangHilangController::class, 'destroy'])->name('validasi.lost-items.destroy');
    
    Route::get('/validasi/found-items/pending', [ValidasiBarangTemuanController::class, 'pending'])->name('validasi.found-items.pending');
    Route::get('/validasi/found-items', [ValidasiBarangTemuanController::class, 'index'])->name('validasi.found-items.index');
    Route::patch('/validasi/found-items/{found_item}/setujui', [ValidasiBarangTemuanController::class, 'setujui'])->name('validasi.found-items.setujui');
    Route::patch('/validasi/found-items/{found_item}/tolak', [ValidasiBarangTemuanController::class, 'tolak'])->name('validasi.found-items.tolak');
});


require __DIR__.'/auth.php';
