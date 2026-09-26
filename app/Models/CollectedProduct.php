<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectedProduct extends Model
{
    protected $guarded = [];

    protected $casts = [
        'collected_date' => 'date',
        'quantity' => 'decimal:4',
        'amount' => 'decimal:4',
    ];

    public function stockCategory(): BelongsTo
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function stockProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'stock_product_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function collectable()
    {
        return $this->morphTo();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
