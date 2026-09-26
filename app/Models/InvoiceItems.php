<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{

   protected $guarded = [];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:4',
        'total_price' => 'decimal:4',
    ];


    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
