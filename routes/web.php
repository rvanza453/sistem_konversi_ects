<?php

use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\TranskripController;

Route::middleware(['auth'])->group(function () {
    // Rute untuk semua user yang terautentikasi (mahasiswa & admin)
    // Contoh: Route::get('/dashboard', ...);

    Route::get('/biodata', [BiodataController::class, 'edit'])->name('biodata.edit');
    Route::post('/biodata', [BiodataController::class, 'update'])->name('biodata.update');
    Route::get('/skl/cetak', [SklController::class, 'cetak'])->name('skl.cetak');
    // Rute khusus Admin
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('matakuliah', MataKuliahController::class);
        Route::get('transkrip', [TranskripController::class, 'index'])->name('transkrip.index');
        Route::post('transkrip', [TranskripController::class, 'store'])->name('transkrip.store');
        Route::get('transkrip/find-mahasiswa', [TranskripController::class, 'findMahasiswa'])->name('transkrip.find');
    });
});