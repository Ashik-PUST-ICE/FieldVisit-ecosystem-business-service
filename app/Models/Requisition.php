<?php

namespace App\Models;

use App\Enums\Commons\RequisitionStatus\RequisitionStatusEnum;
use App\Traits\HasStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasStatus, Searchable;

    protected $guarded = [];

    protected array $searchable = ['requisition_code', 'product_code', 'purpose', 'remarks'];

    protected function casts(): array
    {
        return [
            'status' => RequisitionStatusEnum::class,
            'approved_at' => 'datetime',
        ];
    }

    public function scopeApproved($query)
    {
        return $query->where('status', RequisitionStatusEnum::APPROVED->value);
    }

    public function stockCategory()
    {
        return $this->belongsTo(StockCategory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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
}
