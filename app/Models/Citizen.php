<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = ['name', 'email'];

    public function passport()
    {
        return $this->hasOne(Passport::class);
    }

    public function vehicles()
{
    return $this->hasMany(Vehicle::class);
}

    public function skills()
{
    return $this->belongsToMany(Skill::class);
}
}