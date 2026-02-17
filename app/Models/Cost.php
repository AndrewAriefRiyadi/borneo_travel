<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'trip_id',
        'bbm_total',
        'bbm_attachment',
        'makan_total',
        'wash_total',
        'parking_total',
        'parking_attachment',
        'repair_total',
        'repair_attachment',
        'pom_total',
        'car_id',
        'cost_total'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
