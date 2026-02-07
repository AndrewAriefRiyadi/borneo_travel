<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'persentase_hasil',
        'tanggungan_koperasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip(){
        return $this->hasMany(Trip::class);
    }
}
