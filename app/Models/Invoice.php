<?php

namespace App\Models;

use App\Models\InvoiceItems;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Commons\Invoice\InvoiceStatusEnum;

class Invoice extends Model
{

     protected $guarded = [];

    protected $casts = [
        'invoice_date' => 'date',
        'recurring_date' => 'date',
        'subtotal' => 'decimal:4',
        'discount_value' => 'decimal:4',
        'discount_amount' => 'decimal:4',
        'additional_amount' => 'decimal:4',
        'vat_percentage' => 'decimal:4',
        'vat_amount' => 'decimal:4',
        'total_amount' => 'decimal:4',
        'is_enabled_vat' => 'boolean',
        'status' => InvoiceStatusEnum::class,
    ];


    public function items()
    {
        return $this->hasMany(InvoiceItems::class);
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

}
