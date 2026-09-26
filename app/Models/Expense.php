<?php

namespace App\Models;

use App\Enums\Commons\PaymentStatus\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
        'payment_status' => PaymentStatusEnum::class,
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function financeCategory()
    {
        return $this->belongsTo(FinanceCategory::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
