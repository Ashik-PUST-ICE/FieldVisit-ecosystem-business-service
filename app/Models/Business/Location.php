<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
        'parent_id',
        'name',
        'name_bn',
        'type',
        'code',
        'lat',
        'lng',
        'sort_order',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    /**
     * Every level of the administrative hierarchy lives in this one table, so
     * a single lookup query powers each dropdown in the outlet form.
     */
    public const TYPES = [
        'division',
        'district',
        'upazila',
        'union',
        'ward',
        'village',
    ];

    /**
     * The level a row of this type must hang off, or null when it is a root.
     *
     * Keeps the tree honest: a village belongs to a ward, never to an upazila.
     */
    public static function parentTypeFor(string $type): ?string
    {
        $index = array_search($type, self::TYPES, true);

        if ($index === false || $index === 0) {
            return null;
        }

        return self::TYPES[$index - 1];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order')->orderBy('name');
    }
}