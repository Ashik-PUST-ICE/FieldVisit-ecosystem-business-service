<?php

namespace App\Models;

use App\Enums\Commons\PayrollRun\PayrollRunStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollRun extends Model
{
    protected $guarded = [];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'processed_at' => 'datetime',
        'status' => PayrollRunStatusEnum::class,
    ];

    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class);
    }
}
