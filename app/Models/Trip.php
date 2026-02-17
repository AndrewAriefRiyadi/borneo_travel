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
        'route_1',
        'route_2',
        'service_type',
        'passengers_amount',
        'departure_total',
        'departure_description',
        'return_total',
        'return_description',
        'fee_total',
        'trip_total'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function cost()
    {
        return $this->hasOne(Cost::class);
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }
}
