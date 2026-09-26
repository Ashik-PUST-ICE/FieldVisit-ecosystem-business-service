<?php

namespace App\Models;

use App\Enums\Commons\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', StatusEnum::ACTIVE);
    }
}
