<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\KartuStokController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
Route::get('/pengadaan/{id}', [PengadaanController::class, 'show'])->name('pengadaan.show');
Route::get('/penerimaan', [PenerimaanController::class, 'index'])->name('penerimaan.index');
Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/retur', [ReturController::class, 'index'])->name('retur.index');
Route::get('/margin-penjualan', [MarginPenjualanController::class, 'index'])->name('margin.index');
Route::get('/kartu-stok', [KartuStokController::class, 'index'])->name('kartu-stok.index');
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::resource('barang', BarangController::class);
