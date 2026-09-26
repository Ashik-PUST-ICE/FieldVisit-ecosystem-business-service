<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $guarded = [];

    public function stockProduct()
    {
        return $this->belongsTo(Product::class, 'stock_product_id');
    }

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stockable()
    {
        return $this->morphTo();
    }
}
