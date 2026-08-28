<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $fillable = [
        'country_id',
        'parent_id',
        'name',
        'slug',
        'level',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            __CLASS__,
            'parent_id'
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            __CLASS__,
            'parent_id'
        );
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function propertySearchRequests(): HasMany
    {
        return $this->hasMany(
            PropertySearchRequest::class
        );
    }
}
