<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurfImage extends Model
{
    protected $guarded = [];

    public function turf()
    {
        return $this->belongsTo(Turf::class);
    }
}
