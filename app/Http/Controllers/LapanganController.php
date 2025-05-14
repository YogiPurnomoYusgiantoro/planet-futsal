<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Field;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LapanganController extends Controller
{
    public function create()
    {
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }

        return view('lapangan.create');
    }

    public function store(Request $request)
    {
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('fields', 'public');

        Field::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('lapangan.create')->with('success', 'Lapangan berhasil ditambahkan!');
    }

    public function schedule()
    {
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }

        $fields = Field::all();
        return view('lapangan.schedule', compact('fields'));
    }

    public function scheduleStore(Request $request)
    {
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'price' => 'required|integer|min:0',
        ]);
    
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
    
        $startTime = \Carbon\Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = \Carbon\Carbon::createFromFormat('H:i', $request->end_time);
    
        $dates = \Carbon\CarbonPeriod::create($startDate, $endDate);
    
        foreach ($dates as $date) {
            $start = $startTime->copy();
        
            while ($start < $endTime) {
                $nextHour = $start->copy()->addHour();
            
                DB::table('schedules')->insert([
                    'field_id' => $request->field_id,
                    'date' => $date->format('Y-m-d'),
                    'start_time' => $start->format('H:i:s'),
                    'end_time' => $nextHour->format('H:i:s'),
                    'price' => $request->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            
                $start = $nextHour;
            }
        }
    
        return redirect()->route('lapangan.schedule')->with('success', 'Jadwal berhasil ditambahkan untuk rentang tanggal tersebut!');
    }

    

    public function jadwal()
    {
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }
        $fields = Field::with('schedules')->get();
        return view('lapangan.jadwal', compact('fields'));
    }

    
    public function booked(Request $request)
    {
        $admin = session('admin_login');
        
        if (!$admin) {
            return redirect('/login');
        }

        $date = $request->query('date', now()->toDateString());

        $schedules = DB::table('schedules')
            ->join('fields', 'schedules.field_id', '=', 'fields.id')
            ->join('booking_sessions', 'schedules.id', '=', 'booking_sessions.schedule_id')
            ->join('bookings', 'booking_sessions.booking_id', '=', 'bookings.id')
            ->join('orders', 'bookings.order_id', '=', 'orders.id')
            ->whereDate('schedules.date', $date)
            ->select(
                'schedules.*',
                'fields.name as field_name',
                'orders.booking_status'
            )
            ->get();
    
        return view('booking.booked', compact('schedules'));
    }


    public function showSchedule($id)
    {
        $admin = session('admin_login');
        if (!$admin) return redirect('/login'); 

        $field = Field::with('schedules')->findOrFail($id);
        return view('lapangan.detail', compact('field'));
    }

    public function updateField(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $field = Field::findOrFail($id);
        $field->name = $request->name;
        $field->save();

        return redirect()->back()->with('success', 'Nama lapangan berhasil diperbarui.');
    }

    public function updateSchedulePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        DB::table('schedules')
            ->where('id', $id)
            ->update(['price' => $request->price]);

        return redirect()->back()->with('success', 'Harga berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $field = Field::findOrFail($id);
        $field->delete();

        return redirect()->route('lapangan.jadwal')->with('success', 'Lapangan berhasil dihapus.');
    }


}
