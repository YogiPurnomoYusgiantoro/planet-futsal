<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['field_id', 'day_of_week', 'start_time', 'end_time', 'price'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}

