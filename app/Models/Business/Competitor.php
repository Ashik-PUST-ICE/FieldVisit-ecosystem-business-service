<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competitor extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function visits(): HasMany
    {
        return $this->hasMany(VisitCompetitor::class);
    }
}
