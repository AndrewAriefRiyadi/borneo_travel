<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'departure_date',
        'return_date',
        'driver_id',
        'car_id',
        'start_place',
        'end_place',
        'service_type',
        'passengers_amount',
        'departure_total',
        'departure_description',
        'return_total',
        'return_description',
        'fee_total',
        'trip_total'
    ];

    public function driver() {
        $this->belongsTo(Driver::class);
    }

    public function car(){
        $this->belongsTo(Car::class);
    }

    public function cost(){
        $this->hasMany(Cost::class);
    }
}
