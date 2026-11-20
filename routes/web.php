<?php

use App\Http\Controllers\Admin\JadwalJemputController;
use App\Http\Controllers\Admin\JenisSampahController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\SetoranController;
use App\Http\Controllers\Admin\TabunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Nasabah\BerandaController;
use App\Http\Controllers\Nasabah\PermintaanJemputController;
use App\Http\Controllers\ProfileController;
use App\Models\JenisSampah;
use App\Http\Controllers\GantiPasswordWajibController;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\BerandaPublikController::class)->name('home');

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->middleware(['auth', 'role:admin'])
    ->name('profile.update');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::post('nasabah/{user}/setujui', [NasabahController::class, 'setujui'])->name('nasabah.setujui');
    Route::post('nasabah/{user}/reset-password', [NasabahController::class, 'resetPassword'])->name('nasabah.reset');
    Route::delete('nasabah/{user}', [NasabahController::class, 'tolak'])->name('nasabah.tolak');

    Route::post('jenis-sampah/harga', [JenisSampahController::class, 'perbaruiHarga'])->name('jenis-sampah.harga');
    Route::resource('jenis-sampah', JenisSampahController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->parameters(['jenis-sampah' => 'jenis']);

    Route::resource('setoran', SetoranController::class)->only(['index', 'store', 'show']);

    Route::get('tabungan', [TabunganController::class, 'index'])->name('tabungan.index');
    Route::get('tabungan/{nasabah}', [TabunganController::class, 'show'])->name('tabungan.show');

    Route::get('penjemputan', [JadwalJemputController::class, 'index'])->name('penjemputan.index');
    Route::post('penjemputan/{penjemputan}/selesai', [JadwalJemputController::class, 'selesai'])->name('penjemputan.selesai');
    Route::post('penjemputan/{penjemputan}/batal', [JadwalJemputController::class, 'batal'])->name('penjemputan.batal');

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

Route::middleware(['auth', 'role:nasabah'])->prefix('nasabah')->name('nasabah.')->group(function () {
    Route::get('beranda', [BerandaController::class, 'beranda'])->name('beranda');
    Route::get('riwayat', [BerandaController::class, 'riwayat'])->name('riwayat');
    Route::get('harga', [BerandaController::class, 'harga'])->name('harga');
    Route::get('notifikasi', [BerandaController::class, 'notifikasi'])->name('notifikasi');

    Route::get('penjemputan', [PermintaanJemputController::class, 'index'])->name('penjemputan.index');
    Route::post('penjemputan', [PermintaanJemputController::class, 'store'])->name('penjemputan.store');
    Route::post('penjemputan/{penjemputan}/batal', [PermintaanJemputController::class, 'batal'])->name('penjemputan.batal');
});

Route::middleware('auth')->group(function () {
    Route::get('/ganti-password', [GantiPasswordWajibController::class, 'tampil'])->name('password.wajib');
    Route::post('/ganti-password', [GantiPasswordWajibController::class, 'simpan'])->name('password.wajib.simpan');
});

Route::get('/admin/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'createAdmin'])->middleware('guest')->name('login.admin');

require __DIR__.'/auth.php';
