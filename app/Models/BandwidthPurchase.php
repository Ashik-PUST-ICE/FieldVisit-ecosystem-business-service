<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BandwidthPurchase extends Model
{

    protected $guarded = [];


    protected $casts = [
        'purchase_date' => 'date',
        'total_amount' => 'decimal:4',
        'discount_value' => 'decimal:4',
        'discount_amount' => 'decimal:4',
        'additional_amount' => 'decimal:4',
        'paid_amount' => 'decimal:4',
        'due_amount' => 'decimal:4',
    ];

    public function items()
    {
        return $this->hasMany(BandwidthPurchaseItem::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
