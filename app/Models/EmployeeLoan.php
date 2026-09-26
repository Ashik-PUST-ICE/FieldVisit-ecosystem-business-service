<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class EmployeeLoan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'principal' => 'decimal:4',
        'outstanding' => 'decimal:4',
        'monthly_installment' => 'decimal:4',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => StatusEnum::class,
    ];
}
