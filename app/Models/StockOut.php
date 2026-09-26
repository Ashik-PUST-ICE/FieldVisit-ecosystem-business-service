<?php

namespace App\Models;

use App\Enums\Commons\StockStatus\StockStatusEnum;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StockStatusEnum::class,
        ];
    }

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function stockProduct()
    {
        return $this->belongsTo(Product::class, 'stock_product_id');
    }

    public function stockHistory()
    {
        return $this->belongsTo(StockHistory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function assignable()
    {
        return $this->morphTo();
    }
}
