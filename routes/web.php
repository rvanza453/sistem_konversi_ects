<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\TranskripController;
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\SklController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/biodata', [BiodataController::class, 'edit'])->name('biodata.edit');
    Route::post('/biodata', [BiodataController::class, 'update'])->name('biodata.update');
    Route::get('/skl/cetak', [SklController::class, 'cetak'])->name('skl.cetak');
    // Rute khusus Admin
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('matakuliah', MataKuliahController::class);
        Route::get('transkrip', [TranskripController::class, 'index'])->name('transkrip.index');
        Route::post('transkrip', [TranskripController::class, 'store'])->name('transkrip.store');
        Route::get('transkrip/find-mahasiswa', [TranskripController::class, 'findMahasiswa'])->name('transkrip.find');
        Route::delete('transkrip/{transkrip}', [TranskripController::class, 'destroy'])->name('transkrip.destroy');
        
        // Rute untuk manajemen admin
        Route::resource('admin', \App\Http\Controllers\Admin\AdminController::class);
    });
});

require __DIR__.'/auth.php';
