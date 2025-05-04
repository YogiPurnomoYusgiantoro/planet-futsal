<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'nullable|email',
        'booking_raw' => 'required'
    ]);

    $bookingItems = explode(',', $request->booking_raw);
    $total = 0;
    foreach ($bookingItems as $item) {
        [$schedule_id, $date, $price] = explode(':', $item);
        $total += (int) $price;
    }

    $order = Order::create([
        'amount' => $total,
        'payment_status' => 'pending',
        'booking_status' => 'pending',
    ]);

    Booking::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'order_id' => $order->id,
    ]);

    return redirect()->route('checkout.success')->with('success', 'Booking berhasil! Silakan lanjut pembayaran.');
}

    public function success(){
        dd("halaman pembayaran");
    }

}
