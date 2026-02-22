<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    protected $fillable = [
        'deposit_id',
        'payment_method',
        'attachment_nota',
        'attachment_transfer',
        'status'
    ];
}
