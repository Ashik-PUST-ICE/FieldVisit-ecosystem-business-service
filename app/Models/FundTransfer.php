<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundTransfer extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transfer_date' => 'datetime',
        ];
    }

    public function accountFrom()
    {
        return $this->belongsTo(Account::class, 'account_from');
    }

    public function accountTo()
    {
        return $this->belongsTo(Account::class, 'account_to');
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
