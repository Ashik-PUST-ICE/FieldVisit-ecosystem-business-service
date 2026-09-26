<?php

namespace App\Models;

use App\Enums\Commons\Status\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,

        ];
    }

    public function parent()
    {
        return $this->belongsTo(StockCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(StockCategory::class, 'parent_id');
    }
}
