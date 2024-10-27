<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman login dengan middleware 'guest' (hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// Group route dengan middleware auth (butuh login untuk akses)
Route::middleware(['auth'])->group(function () {
    // Route untuk halaman utama (hanya bisa diakses jika sudah login)
    Route::get('/', [BarangController::class, 'index'])->name('home');

    // Route resource untuk CRUD barang
    Route::resource('barang', BarangController::class);

    // AJAX barang index
    Route::get('barang', [BarangController::class, 'index'])->name('barang.index');

    // Rute untuk mencetak satu barang
    Route::get('barang/cetak-pdf/{kode_barang}', [BarangController::class, 'cetakPDF'])->name('barang.cetak-pdf');

    // Rute untuk mencetak semua barang
    Route::get('/cetaksemua', [BarangController::class, 'cetaksemua'])->name('cetaksemua');

    // Route untuk logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});
