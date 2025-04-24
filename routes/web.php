<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LaporanController;


Route::get('/', function () {
    return view('customer.booking-name');
});

Route::get('admin/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
Route::post('admin/lapangan/store', [LapanganController::class, 'store'])->name('lapangan.store');

Route::get('admin/lapangan/schedule/available', [LapanganController::class, 'jadwal'])->name('lapangan.jadwal');
Route::get('admin/lapangan/schedule', [LapanganController::class, 'schedule'])->name('lapangan.schedule');
Route::post('admin/lapangan/schedule', [LapanganController::class, 'scheduleStore'])->name('lapangan.schedule.store');

Route::get('admin/laporan-keuangan', [LaporanController::class, 'index'])->name('laporan.keuangan');

