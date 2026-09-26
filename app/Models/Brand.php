<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }
}
