<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
Auth::routes();
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;

Route::middleware(['isAdministrator'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::middleware(['isAdministrator'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('admin.dashboard');
});

// resepsionis
Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\Resepsionis\DashboardResepsionisController::class, 'index'])
        ->name('resepsionis.dashboard');
});

// dokter
Route::middleware(['isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])->name('dokter.dashboard');
});

// perawat
Route::middleware(['isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [App\Http\Controllers\Perawat\DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
});

// pemilik
Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\Pemilik\DashboardPemilikController::class, 'index'])
        ->name('pemilik.dashboard');
});


// Halaman Utama & Koneksi Database
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');


// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

// Halaman
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('site.kontak');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('site.struktur');

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/jenis', [AdminController::class, 'jenis']);
Route::get('/admin/ras', [AdminController::class, 'ras']);
Route::get('/admin/kategori', [AdminController::class, 'kategori']);
Route::get('/admin/kategori-klinis', [AdminController::class, 'kategoriKlinis']);
Route::get('/admin/tindakan-terapi', [AdminController::class, 'tindakanTerapi']);
Route::get('/admin/pet', [AdminController::class, 'pet']);
Route::get('/admin/role', [AdminController::class, 'role']);
Route::get('/admin/user', [AdminController::class, 'user']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/jenis', [JenisHewanController::class, 'index'])->name('jenis.index');
    Route::get('/jenis/create', [JenisHewanController::class, 'create'])->name('jenis.create');
    Route::post('/jenis', [JenisHewanController::class, 'store'])->name('jenis.store');
    Route::get('/jenis/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis.edit');
    Route::put('/jenis/{id}', [JenisHewanController::class, 'update'])->name('jenis.update');
    Route::delete('/jenis/{id}', [JenisHewanController::class, 'destroy'])->name('jenis.destroy');

});

Route::prefix('admin')->name('admin.')->group(function () {
    // 🔹 CRUD Ras Hewan
    Route::get('/ras', [RasHewanController::class, 'index'])->name('ras.index');
    Route::get('/ras/create', [RasHewanController::class, 'create'])->name('ras.create');
    Route::post('/ras', [RasHewanController::class, 'store'])->name('ras.store');
    Route::get('/ras/{id}/edit', [RasHewanController::class, 'edit'])->name('ras.edit');
    Route::put('/ras/{id}', [RasHewanController::class, 'update'])->name('ras.update');
    Route::delete('/ras/{id}', [RasHewanController::class, 'destroy'])->name('ras.destroy');
});