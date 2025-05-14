<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Order;
use App\Models\BookingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'booking_raw' => 'required'
        ]);

        // Split raw booking data
        $bookingItems = explode(',', $request->booking_raw);
        $total = 0;
        $schedules = [];

        // Process each booking item
        foreach ($bookingItems as $item) {
            [$schedule_id, $date, $price] = explode(':', $item);
            $total += (int) $price;
            $schedules[] = [
                'schedule_id' => $schedule_id,
                'session_date' => $date,
                'price' => $price,
            ];
        }

        // Create Order
        $order = Order::create([
            'amount' => $total,
            'payment_status' => 'pending',
            'booking_status' => 'pending',
            'booking_code' => 'PF-' . Str::random(4),
        ]);

        // Create Booking
        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'order_id' => $order->id,
        ]);

        // Create Booking Sessions
        foreach ($schedules as $schedule) {
            BookingSession::create([
                'booking_id' => $booking->id,
                'schedule_id' => $schedule['schedule_id'],
                'session_date' => $schedule['session_date'],
            ]);
        }

        // Configure Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false; // Set to false for local dev or staging

        // Prepare Midtrans transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $order->booking_code,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Return snap token to view for payment process
        return response()->json(['snap_token' => $snapToken, 'booking_code' => $order->booking_code]);
    }
}
