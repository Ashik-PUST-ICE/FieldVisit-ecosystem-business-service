<?php

namespace App\Models;

use App\Enums\Commons\TransactionType\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
        'type' => TransactionTypeEnum::class,
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactionable()
    {
        return $this->morphTo();
    }
}
