<?php

namespace App\Models;

use App\Enums\Commons\StockStatus\StockStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StockStatusEnum::class,
        ];
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', StockStatusEnum::AVAILABLE->value);
    }

    public function scopeHasQuantity(Builder $query): Builder
    {
        return $query->where('quantity', '>', 0);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function stockProduct()
    {
        return $this->belongsTo(Product::class, 'stock_product_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
