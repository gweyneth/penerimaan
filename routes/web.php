<?php

use Illuminate\Support\Facades\Route;

// Controller untuk otentikasi
use App\Http\Controllers\Auth\LoginController;

// Controller untuk halaman publik
use App\Http\Controllers\CekKelulusanController;

// Middleware untuk proteksi
use App\Http\Middleware\IsAdmin;

// Controller untuk area Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PenerimaController;
use App\Http\Controllers\Admin\KodeAksesController;
use App\Http\Controllers\Admin\AkunSiswaController;

// Controller untuk area Siswa
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda bisa mendaftarkan rute web untuk aplikasi Anda.
|
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- RUTE PUBLIK UNTUK CEK KELULUSAN ---
Route::get('/cek-kelulusan', [CekKelulusanController::class, 'showCheckForm'])->name('kelulusan.form');
Route::post('/cek-kelulusan', [CekKelulusanController::class, 'checkKelulusan'])->name('kelulusan.check');


// --- RUTE UNTUK OTENTIKASI (LOGIN & LOGOUT) ---
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// --- RUTE UNTUK SISWA (SETELAH LOGIN) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
});


// --- GRUP RUTE KHUSUS ADMIN ---
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute untuk dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk Kelola Penerima
    Route::resource('penerima', PenerimaController::class);
    
    // Rute untuk Kelola Kode Akses
    Route::resource('kode-akses', KodeAksesController::class);
    
    // Rute untuk Kelola Akun Siswa
    Route::get('akun-siswa', [AkunSiswaController::class, 'index'])->name('akun-siswa.index');
    Route::post('akun-siswa', [AkunSiswaController::class, 'store'])->name('akun-siswa.store');
    Route::get('akun-siswa/daftar', [AkunSiswaController::class, 'daftarAkun'])->name('akun-siswa.daftar');
    Route::post('akun-siswa/{user}/reset', [AkunSiswaController::class, 'resetPassword'])->name('akun-siswa.reset');

    // Rute untuk mencetak PDF
    Route::get('akun-siswa/cetak-pdf', [AkunSiswaController::class, 'cetakPdf'])->name('akun-siswa.cetak-pdf');
    
});
