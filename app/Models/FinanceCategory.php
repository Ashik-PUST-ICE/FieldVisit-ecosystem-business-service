<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class FinanceCategory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
    ];
}
