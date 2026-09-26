<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryComponent extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:4',
        'effective_from' => 'date',
        'effective_to' => 'date',
    ];

    public function payElement(): BelongsTo
    {
        return $this->belongsTo(PayElement::class);
    }
}
