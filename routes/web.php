<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ValidasiBarangHilangController;
use App\Http\Controllers\Admin\ValidasiBarangTemuanController;


// --- ROUTE HOME ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- ROUTE TERHADAP USER LOGIN ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Lost & Found Items
    Route::resource('lost-items', LostItemController::class)->names('lost-items');
    Route::patch('lost-items/{lost_item}/mark-as-done', [LostItemController::class, 'markAsDone'])->name('lost-items.markAsDone');

    Route::resource('found-items', FoundItemController::class)->names('found-items');
    Route::patch('found-items/{found_item}/mark-as-done', [FoundItemController::class, 'markAsDone'])->name('found-items.markAsDone');
});

// --- ROUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Manajemen User
    Route::resource('users', UserController::class);

    // Validasi Barang Hilang
    Route::prefix('validasi/lost-items')->name('validasi.lost-items.')->group(function () {
        Route::get('/', [ValidasiBarangHilangController::class, 'index'])->name('index');
        Route::get('/pending', [ValidasiBarangHilangController::class, 'pending'])->name('pending');
        Route::patch('{lost_item}/setujui', [ValidasiBarangHilangController::class, 'setujui'])->name('setujui');
        Route::patch('{lost_item}/tolak', [ValidasiBarangHilangController::class, 'tolak'])->name('tolak');
        Route::delete('{lost_item}', [ValidasiBarangHilangController::class, 'destroy'])->name('destroy');
        Route::get('/export-excel', [ValidasiBarangHilangController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/export-pdf', [ValidasiBarangHilangController::class, 'exportPdf'])->name('exportPdf');
    });

    // Validasi Barang Temuan
    Route::prefix('validasi/found-items')->name('validasi.found-items.')->group(function () {
        Route::get('/', [ValidasiBarangTemuanController::class, 'index'])->name('index');
        Route::get('/pending', [ValidasiBarangTemuanController::class, 'pending'])->name('pending');
        Route::patch('{found_item}/setujui', [ValidasiBarangTemuanController::class, 'setujui'])->name('setujui');
        Route::patch('{found_item}/tolak', [ValidasiBarangTemuanController::class, 'tolak'])->name('tolak');
        Route::delete('{found_item}', [ValidasiBarangTemuanController::class, 'destroy'])->name('destroy');
        Route::get('/export-excel', [ValidasiBarangTemuanController::class, 'exportExcel'])->name('exportExcel');
        Route::get('/export-pdf', [ValidasiBarangTemuanController::class, 'exportPdf'])->name('exportPdf');
    });
});

require __DIR__ . '/auth.php';
