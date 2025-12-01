<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;

// ADMIN
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\TindakanTerapiController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetController;

// RESEPSIONIS
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\PendaftaranController;

// =========================
// HALAMAN PUBLIC
// =========================
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('site.kontak');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('site.struktur');

// =========================
// LOGIN - LOGOUT
// =========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================
// ADMIN
// =========================
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    Route::resource('jenis', JenisHewanController::class);
    Route::resource('ras', RasHewanController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategori-klinis', KategoriKlinisController::class)->names('kategori_klinis');
    Route::resource('tindakan-terapi', TindakanTerapiController::class)->names('tindakan_terapi');
    Route::resource('pet', PetController::class)->names('pet');
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
});

// =========================
// RESEPSIONIS
// =========================
Route::middleware('resepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');
});

// =========================
// DOKTER
// =========================
Route::middleware('dokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])
        ->name('dashboard');
});

// =========================
// PERAWAT
// =========================
Route::middleware('perawat')->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Perawat\DashboardPerawatController::class, 'index'])
        ->name('dashboard');
});

// =========================
// PEMILIK
// =========================
Route::middleware('pemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Pemilik\DashboardPemilikController::class, 'index'])
        ->name('dashboard');
});





// Halaman Utama
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Informasi
Route::get('/layanan', [SiteController::class, 'layanan'])->name('site.layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('site.kontak');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('site.struktur');


// ==========================
// CRUD ADMIN
// ==========================

// JENIS
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/jenis', [JenisHewanController::class, 'index'])->name('jenis.index');
    Route::get('/jenis/create', [JenisHewanController::class, 'create'])->name('jenis.create');
    Route::post('/jenis', [JenisHewanController::class, 'store'])->name('jenis.store');
    Route::get('/jenis/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis.edit');
    Route::put('/jenis/{id}', [JenisHewanController::class, 'update'])->name('jenis.update');
    Route::delete('/jenis/{id}', [JenisHewanController::class, 'destroy'])->name('jenis.destroy');
});

// RAS
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/ras', [RasHewanController::class, 'index'])->name('ras.index');
    Route::get('/ras/create', [RasHewanController::class, 'create'])->name('ras.create');
    Route::post('/ras', [RasHewanController::class, 'store'])->name('ras.store');
    Route::get('/ras/{id}/edit', [RasHewanController::class, 'edit'])->name('ras.edit');
    Route::put('/ras/{id}', [RasHewanController::class, 'update'])->name('ras.update');
    Route::delete('/ras/{id}', [RasHewanController::class, 'destroy'])->name('ras.destroy');
});

// KATEGORI
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

// KATEGORI KLINIS
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori_klinis.index');
    Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori_klinis.create');
    Route::post('/kategori-klinis', [KategoriKlinisController::class, 'store'])->name('kategori_klinis.store');
    Route::get('/kategori-klinis/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('kategori_klinis.edit');
    Route::put('/kategori-klinis/{id}', [KategoriKlinisController::class, 'update'])->name('kategori_klinis.update');
    Route::delete('/kategori-klinis/{id}', [KategoriKlinisController::class, 'destroy'])->name('kategori_klinis.destroy');
});

// TINDAKAN TERAPI
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tindakan-terapi', TindakanTerapiController::class)->names('tindakan_terapi');
});

// PET
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('pet.index');
    Route::get('/pet/create', [App\Http\Controllers\Admin\PetController::class, 'create'])->name('pet.create');
    Route::post('/pet', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('pet.store');
    Route::get('/pet/{id}/edit', [App\Http\Controllers\Admin\PetController::class, 'edit'])->name('pet.edit');
    Route::put('/pet/{id}', [App\Http\Controllers\Admin\PetController::class, 'update'])->name('pet.update');
    Route::delete('/pet/{id}', [App\Http\Controllers\Admin\PetController::class, 'destroy'])->name('pet.destroy');
});

// ROLE
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});

// USER
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// RESEPSIONIS 

    // CRUD Pemilik
    Route::resource('pemilik', App\Http\Controllers\Resepsionis\PemilikController::class);

    // CRUD Pet
    Route::resource('pet', App\Http\Controllers\Resepsionis\PetController::class);

    // CRUD Pendaftaran (Temu Dokter)
    Route::resource('pendaftaran', App\Http\Controllers\Resepsionis\PendaftaranController::class);

