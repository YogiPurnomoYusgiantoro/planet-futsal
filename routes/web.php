<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckinController;


Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/booking', function () {
    return view('customer.booking-check');
});

Route::get('/', [MainController::class, 'index'])->name('home');


Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
Route::post('/admin/lapangan/store', [LapanganController::class, 'store'])->name('lapangan.store');

Route::get('/admin/lapangan/schedule/available', [LapanganController::class, 'jadwal'])->name('lapangan.jadwal');
Route::get('/admin/lapangan/schedule', [LapanganController::class, 'schedule'])->name('lapangan.schedule');
Route::post('/admin/lapangan/schedule', [LapanganController::class, 'scheduleStore'])->name('lapangan.schedule.store');

Route::get('/admin/laporan/keuangan', [LaporanController::class, 'laporanKeuangan'])->name('laporan.keuangan');
Route::get('/admin/laporan/keuangan/pdf', [LaporanController::class, 'downloadPDF'])->name('laporan.keuangan.pdf');


Route::get('/fields/{id}', [MainController::class, 'show']);

Route::get('/checkout', fn() => view('customer.checkout'))->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/payment/update', [PaymentController::class, 'updatePage'])->name('payment.update');
Route::post('/payment/update', [PaymentController::class, 'updatePaymentStatus'])->name('payment.update.store');

Route::get('/qr/checkin', [CheckinController::class, 'main']);
Route::get('/api/checkin/{booking_code}', [CheckInController::class, 'checkBookingStatus']);

Route::get('/admin/lapangan/booked', [LapanganController::class, 'booked'])->name('lapangan.booked');
Route::get('/admin/lapangan/schedule/{id}', [LapanganController::class, 'showSchedule']);

Route::put('/admin/lapangan/{id}/update', [LapanganController::class, 'updateField'])->name('field.update');
Route::put('/admin/schedule/{id}/update-price', [LapanganController::class, 'updateSchedulePrice'])->name('schedule.updatePrice');
Route::delete('/admin/lapangan/{id}', [LapanganController::class, 'destroy'])->name('field.destroy');



