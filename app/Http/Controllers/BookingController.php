<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class BookingController extends Controller
{
    public function search(Request $request)
    {
        $kode = $request->kode_booking;
        
        $booking = DB::table('orders')
        ->join('bookings', 'orders.id', '=', 'bookings.order_id')
        ->join('booking_sessions', 'bookings.id', '=', 'booking_sessions.booking_id')
        ->join('schedules', 'booking_sessions.schedule_id', '=', 'schedules.id')
        ->join('fields', 'schedules.field_id', '=', 'fields.id')
        ->where('orders.booking_code', $kode)
        ->select(
            'orders.booking_code',
            'bookings.name AS customer_name',
            'bookings.email AS customer_email',
            'bookings.phone AS customer_phone',
            'fields.name AS field_name',
            'schedules.date AS session_date',
            'schedules.start_time',
            'schedules.end_time'
        )
        ->get();

        if ($booking->isEmpty()) {
            return view('booking.notfound', compact('booking'));
        }

        $qrCode = QrCode::size(200)->generate($kode);

        return view('booking.result', compact('booking', 'qrCode'));
    }
}
