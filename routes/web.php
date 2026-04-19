<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController; // Wajib ditambahkan di paling atas

Route::get('/', function () {
    return view('welcome');
});

// Redirect Dinamis Setelah Login
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'pemilik') {
        return redirect()->route('pemilik.dashboard');
    }
    return redirect()->route('penyewa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// GRUP ROUTE UNTUK PEMILIK (ADMIN)
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('pemilik.dashboard'); 
    })->name('dashboard');

    // Route resource untuk Tipe Kamar dimasukkan ke sini
    Route::resource('room-types', RoomTypeController::class);
    
});

// GRUP ROUTE UNTUK PENYEWA
Route::middleware(['auth', 'role:penyewa'])->prefix('penyewa')->name('penyewa.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('penyewa.dashboard'); 
    })->name('dashboard');
    
});

require __DIR__.'/auth.php';