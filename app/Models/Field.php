<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function schedules()
    {
       return $this->hasMany(Schedule::class);
    }

}
