<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visit extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(VisitPhoto::class);
    }

    public function competitors(): HasMany
    {
        return $this->hasMany(VisitCompetitor::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(VisitProduct::class);
    }
}
