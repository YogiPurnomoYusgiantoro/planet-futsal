<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Field;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;


class LapanganController extends Controller
{
    public function create()
    {
        return view('lapangan.create');
    }

    public function store(Request $request)
    {
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
        $fields = Field::all();
        return view('lapangan.schedule', compact('fields'));
    }

    public function scheduleStore(Request $request)
    {
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
       $fields = Field::with('schedules')->get();
       return view('lapangan.jadwal', compact('fields'));
    }
}
