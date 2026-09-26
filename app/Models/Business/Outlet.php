<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlet extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'geofence_radius' => 'integer',
        ];
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function beatOutlets(): HasMany
    {
        return $this->hasMany(BeatOutlet::class);
    }
}
