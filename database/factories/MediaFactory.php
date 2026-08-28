<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => fake()->imageUrl(1280, 720, 'realestate', true),
            'entity_type' => Property::class,
            'entity_id' => Property::factory(),
            'type' => 'image',
            'sort_order' => fake()->numberBetween(1, 10),
            'metadata' => [
                'mime_type' => 'image/jpeg',
                'size' => fake()->numberBetween(100000, 5000000), // bytes
                'width' => 1280,
                'height' => 720,
                'alt' => fake()->sentence(3),
            ],
        ];
    }

    public function forEntity(Model $entity): static
    {
        return $this->state(fn (array $attributes) => [
            'entity_type' => $entity->getMorphClass(),
            'entity_id' => $entity->getKey(),
        ]);
    }

    public function video(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9_-]{11}'),
            'metadata' => [
                'provider' => 'youtube',
                'duration' => fake()->numberBetween(30, 300), // seconds
            ],
        ]);
    }

    public function document(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'document',
            'url' => fake()->url() . '/brochure.pdf',
            'metadata' => [
                'mime_type' => 'application/pdf',
                'size' => fake()->numberBetween(500000, 10000000),
                'filename' => 'property-brochure.pdf',
            ],
        ]);
    }
}
