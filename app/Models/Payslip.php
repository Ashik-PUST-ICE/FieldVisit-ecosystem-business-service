<?php

namespace App\Models;

use App\Enums\Commons\Payslip\PayslipStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gross_pay' => 'decimal:4',
        'total_deductions' => 'decimal:4',
        'net_pay' => 'decimal:4',
        'issued_at' => 'date',
        'status' => PayslipStatusEnum::class,
    ];

    public function payrollRun(): BelongsTo
    {
        return $this->belongsTo(PayrollRun::class);
    }
}
