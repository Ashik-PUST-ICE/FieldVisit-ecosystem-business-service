<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BandwidthPurchaseItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'quantity' => 'integer',
        'amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];


    public function bandwidthPurchase()
    {
        return $this->belongsTo(BandwidthPurchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
