<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;



class MainController extends Controller
{
    public function index(){
        $fields = Field::with('schedules')->get();
        return view('customer.main', compact('fields'));
    }

    public function show($id)
    {
        $field = Field::with('schedules')->findOrFail($id);
        
        $bookedSessions = DB::table('booking_sessions')
            ->join('schedules', 'booking_sessions.schedule_id', '=', 'schedules.id')
            ->where('schedules.field_id', $id)
            ->get();
    
        $schedules = $field->schedules->groupBy('date');
        
        return view('customer.detail-field', compact('field', 'schedules', 'bookedSessions'));
    }
    

}
