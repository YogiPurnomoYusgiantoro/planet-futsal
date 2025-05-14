<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class CheckinController extends Controller
{
    public function main(){
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }

        return view('qr.checkin');
    }

    public function checkBookingStatus($bookingCode)
    {

        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }
        
        $order = Order::where('booking_code', $bookingCode)->first();   

        if ($order) {
            if ($order->booking_status === 'pending') {
                $order->booking_status = 'done';
                $order->save(); 

                return response()->json(['success' => true, 'status' => 'pending']);
            } else {
                return response()->json(['success' => true, 'status' => 'done']);
            }
        }   

        return response()->json(['success' => false]);
    }
}
