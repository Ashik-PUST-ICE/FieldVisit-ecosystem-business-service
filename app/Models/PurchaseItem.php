<?php

namespace App\Models;

use App\Enums\Commons\StockStatus\StockStatusEnum;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StockStatusEnum::class,
        ];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
