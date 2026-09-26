<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conveyance extends Model
{
    protected $guarded = [];

    protected $casts = [
        'biling_date' => 'date',
        'amount' => 'decimal:2',
    ];

    // public function account()
    // {
    //     return $this->belongsTo(Account::class);
    // }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
