<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayslipLine extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:4',
        'quantity' => 'decimal:4',
        'is_earning' => 'boolean',
        'taxable' => 'boolean',
    ];

    public function payslip(): BelongsTo
    {
        return $this->belongsTo(Payslip::class);
    }

    public function payElement(): BelongsTo
    {
        return $this->belongsTo(PayElement::class);
    }
}
