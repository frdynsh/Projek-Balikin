<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Dashboard Admin
    Route::get('/dashboard', function () {
        // Kita akan arahkan ke file view di: resources/views/admin/dashboard.blade.php
        return view('admin.dashboard'); 
    })->name('dashboard');

    // Nanti route untuk manajemen user kita letakkan di sini juga
});

require __DIR__.'/auth.php';
