<?php

// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;

class PaymentController extends Controller
{
    /**
     * Show the payment update page.
     */
    public function updatePage(Request $request)
    {
        $bookingCode = $request->query('booking_code');
        $order = Order::where('booking_code', $bookingCode)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order tidak ditemukan');
        }

        return view('payment.update', compact('order'));
    }


    public function updatePaymentStatus(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|exists:orders,booking_code'
        ]);
    
        $booking_code = $request->booking_code;
    
        $order = Order::where('booking_code', $booking_code)
            ->join('bookings', 'orders.id', '=', 'bookings.order_id') 
            ->select('orders.*', 'bookings.email')
            ->first();
    
        if ($order) {
            $order->payment_status = 'success';
            $order->save();
    
            Mail::to($order->email)->send(new PaymentSuccessMail($order));
    
            return view('payment.success', compact('booking_code'));
        }
    
        dd('Order not found');
    }
    
}

