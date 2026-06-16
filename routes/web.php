<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestRoutingController;

// Jalur halaman utama form input tamu
Route::get('/', [GuestRoutingController::class, 'index'])->name('anjungan.index');

// Jalur pemrosesan algoritma saat tombol submit ditekan
Route::post('/process-routing', [GuestRoutingController::class, 'processRouting'])->name('anjungan.submit');