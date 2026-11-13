<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['citizen_id', 'vehicle_type', 'plate_number'];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }
}