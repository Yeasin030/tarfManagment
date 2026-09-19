<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turf extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(TurfImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'turf_facility');
    }

    public function pricings()
    {
        return $this->hasMany(TurfPricing::class);
    }

    public function schedules()
    {
        return $this->hasMany(TurfSchedule::class);
    }
}
