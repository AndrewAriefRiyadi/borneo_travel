<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'unit_identity',
    ];

    public function trip()
    {
        return $this->hasMany(Trip::class);
    }

    public function cost()
    {
        return $this->hasMany(Cost::class);
    }
}
