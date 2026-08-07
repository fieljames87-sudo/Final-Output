<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
    'name',
    'description',
    'capacity',
    'image',
    ];

     public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class);
    }
}


