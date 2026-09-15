<?php

namespace App\Models;

use App\Models\Enum\PropertyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'location_id',
        'ref',
        'title',
        'slug',
        'description',
        'price',
        'options',
        'status',
        'published_at',
        'is_featured',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'price' => 'decimal:2',
            'published_at' => 'datetime',
            "status" => PropertyStatus::class,
            'is_featured' => 'boolean',
            'views_count' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(
            Media::class,
            'entity'
        );
    }
}
