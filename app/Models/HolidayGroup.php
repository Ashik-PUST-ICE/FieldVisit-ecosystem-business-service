<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class HolidayGroup extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', StatusEnum::ACTIVE);
    }
}
