<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'field_id',
        'day_of_week',
        'start_time',
        'end_time',
        'price',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
