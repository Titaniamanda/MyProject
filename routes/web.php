<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    return view('auth.login'); // user belum login, tampilkan halaman login (default Laravel)
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('barang', BarangController::class);

    Route::resource('kategori', KategoriBarangController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('transaksi', TransaksiBarangController::class);


    Route::resource('supplier', SupplierController::class);

    Route::get('/profile', function () {
        $user = auth()->user();
        return "Halo, " . ($user ? $user->name : 'Guest');
    })->name('profile');

});
