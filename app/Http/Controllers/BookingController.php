<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function search(Request $request)
{
    $kode = $request->kode_booking;
    
    //$booking = Booking::where('kode_booking', $kode)->first();

    if ($booking) {
        return view('booking.result', compact('booking'));
    } else {
        return back()->with('error', 'Kode booking tidak ditemukan.');
    }
}
}
