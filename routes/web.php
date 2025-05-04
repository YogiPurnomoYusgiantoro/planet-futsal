<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CheckoutController;


Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/booking', function () {
    return view('customer.booking-check');
});

Route::get('/', [MainController::class, 'index']);

Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
Route::post('/admin/lapangan/store', [LapanganController::class, 'store'])->name('lapangan.store');

Route::get('/admin/lapangan/schedule/available', [LapanganController::class, 'jadwal'])->name('lapangan.jadwal');
Route::get('/admin/lapangan/schedule', [LapanganController::class, 'schedule'])->name('lapangan.schedule');
Route::post('/admin/lapangan/schedule', [LapanganController::class, 'scheduleStore'])->name('lapangan.schedule.store');

Route::get('/admin/laporan-keuangan', [LaporanController::class, 'index'])->name('laporan.keuangan');

Route::get('/fields/{id}', [MainController::class, 'show']);

Route::get('/checkout', fn() => view('customer.checkout'))->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
//Route::get('/checkout/success/{booking_code}', [CheckoutController::class, 'success'])->name('checkout.success');

