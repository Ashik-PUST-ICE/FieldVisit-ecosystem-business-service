<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayElement extends Model
{
    protected $guarded = [];

    protected $casts = [
        'default_amount' => 'decimal:4',

    ];
}
