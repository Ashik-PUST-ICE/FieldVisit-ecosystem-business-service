<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Commons\Status\StatusEnum;
use App\Enums\Commons\StockStatus\StockStatusEnum;

class Product extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'stock_product_id');
    }

    public function availableStocks()
    {
        return $this->hasMany(Stock::class, 'stock_product_id')->available()->hasQuantity();
    }
}
