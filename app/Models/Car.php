<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'unit_identity',
    ];

    public function trip(){
        $this->hasMany(Trip::class);
    }

    public function cost(){
        $this->hasMany(Cost::class);
    }
}
