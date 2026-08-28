<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertySearchRequest extends Model
{
    /** @use HasFactory<\Database\Factories\PropertySearchRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'mobile_number_country',
        'email',
        'category_id',
        'location_id',
        'options',
        'message',
        'budget',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'budget' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
