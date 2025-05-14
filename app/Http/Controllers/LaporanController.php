<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{

    public function laporanKeuangan(Request $request)
    {
        $query = DB::table('orders')
            ->join('bookings', 'orders.id', '=', 'bookings.order_id')
            ->join('schedules', 'bookings.id', '=', 'schedules.id')
            ->join('fields', 'schedules.field_id', '=', 'fields.id')
            ->select(
                'orders.created_at as date',
                'fields.name as field_name',
                'schedules.price'
            )
            ->where('orders.payment_status', 'success');

        if ($request->filter === 'today') {
            $query->whereDate('orders.created_at', Carbon::today());
        } elseif ($request->filter === 'month') {
            $query->whereMonth('orders.created_at', Carbon::now()->month)
                  ->whereYear('orders.created_at', Carbon::now()->year);
        } elseif ($request->filter === 'year') {
            $query->whereYear('orders.created_at', Carbon::now()->year);
        }

        if ($request->filled(['from', 'to'])) {
            $query->whereBetween('orders.created_at', [$request->from, $request->to]);
        }

        $orders = $query->get();

        return view('admin.laporan', compact('orders'));
    }

    public function downloadPDF(Request $request)
    {
        $orders = $this->getFilteredOrders($request);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.keuangan_pdf', compact('orders'));
        return $pdf->download('laporan_keuangan.pdf');
    }

    private function getFilteredOrders(Request $request)
    {
        $query = DB::table('orders')
            ->join('bookings', 'orders.id', '=', 'bookings.order_id')
            ->join('booking_sessions', 'bookings.id', '=', 'booking_sessions.booking_id')
            ->join('schedules', 'booking_sessions.schedule_id', '=', 'schedules.id')
            ->join('fields', 'schedules.field_id', '=', 'fields.id')
            ->select(
                'orders.created_at as date',
                'fields.name as field_name',
                'schedules.price'
            )
            ->where('orders.payment_status', 'success');

        if ($request->filter === 'today') {
            $query->whereDate('orders.created_at', Carbon::today());
        } elseif ($request->filter === 'month') {
            $query->whereMonth('orders.created_at', Carbon::now()->month)
                  ->whereYear('orders.created_at', Carbon::now()->year);
        } elseif ($request->filter === 'year') {
            $query->whereYear('orders.created_at', Carbon::now()->year);
        }

        if ($request->filled(['from', 'to'])) {
            $query->whereBetween('orders.created_at', [$request->from, $request->to]);
        }

        return $query->get();
    }


}
