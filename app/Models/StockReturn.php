<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockReturn extends Model
{
    protected $guarded = [];

    protected $casts = [
        'return_date' => 'date',
    ];

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function stockProduct()
    {
        return $this->belongsTo(Product::class, 'stock_product_id');
    }

    public function returnProduct()
    {
        return $this->belongsTo(Product::class, 'return_product_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function returnable()
    {
        return $this->morphTo();
    }
}
