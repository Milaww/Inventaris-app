<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\barangMasukController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
    })->middleware('guest')->name('login');
    
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::middleware(['auth'])->group(function () {
    //barang
    route::get('/barang', [App\Http\Controllers\barangController::class, 'index'])->name('barang.index');
    route::get('/barang/create', [App\Http\Controllers\barangController::class, 'create'])->name('barang.create');
    route::get('/barang/show/{id}', [App\Http\Controllers\barangController::class, 'show'])->name('barang.show');
    route::post('/barang/store', [App\Http\Controllers\barangController::class, 'store'])->name('barang.store');
    route::get('/barang/edit/{barang}', [App\Http\Controllers\barangController::class, 'edit'])->name('barang.edit');
    route::put('/barang/update/{barang}', [App\Http\Controllers\barangController::class, 'update'])->name('barang.update');
    route::delete('/barang/destroy/{barang}', [App\Http\Controllers\barangController::class, 'destroy'])->name('barang.destroy');
    //unit barang
    Route::get('/barang/unit/tambah', [BarangController::class, 'createUnit'])->name('barang.unit.create');
    Route::post('/barang/unit', [BarangController::class, 'storeUnit'])->name('barang.unit.store');
    Route::get('barang/{barang}/unit/{unit}/edit', [BarangController::class, 'editUnit'])->name('barang.unit.edit');
    Route::put('barang/{barang}/unit/{unit}', [BarangController::class, 'updateUnit'])->name('barang.unit.update');
    Route::delete('barang/{barang}/unit/{unit}', [BarangController::class, 'destroyUnit'])->name('barang.unit.destroy');
    //barang masuk
    route::get('/barang-masuk/index', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    // Route::get('/barang-masuk/create/{id}', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
    // Route::post('/barang-masuk/store', [BarangMasukController::class, 'store'])->name('barang-masuk.store');

    //barang keluar
    route::get('/barang-keluar/index', [App\Http\Controllers\barangKeluarController::class, 'index'])->name('barang-keluar.index');

    //laporan

    // Route halaman laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Route untuk mencetak
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    //route user management
    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::resource('users', UserController::class);
    });

    //route lokasi
    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::resource('lokasi', LokasiController::class);
    });
    



});
require __DIR__.'/auth.php';
