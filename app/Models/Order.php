<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['amount', 'payment_status', 'booking_code', 'booking_status'];

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
