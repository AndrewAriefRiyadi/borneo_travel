<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'trip_id',
        'total_deposit',
        'total_driver',
        'total_company',
        'total_koperasi'
    ];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
