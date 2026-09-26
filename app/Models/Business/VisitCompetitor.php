<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitCompetitor extends Model
{
    protected $guarded = [];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function competitor(): BelongsTo
    {
        return $this->belongsTo(Competitor::class);
    }
}
