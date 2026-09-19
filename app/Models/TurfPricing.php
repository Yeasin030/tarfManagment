<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurfPricing extends Model
{
    protected $guarded = [];

    public function turf()
    {
        return $this->belongsTo(Turf::class);
    }
}
