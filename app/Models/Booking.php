<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
