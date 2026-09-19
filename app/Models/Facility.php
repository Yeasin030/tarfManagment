<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function turfs()
    {
        return $this->belongsToMany(Turf::class, 'turf_facility');
    }
}
