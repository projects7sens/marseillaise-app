<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Enum\PropertyStatus;
use App\Models\Location;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'location_id' => Location::factory(),
            'ref' => 'PROP-' . strtoupper(Str::random(8)),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 50000, 1500000),
            'options' => [
                'bedrooms' => fake()->numberBetween(1, 6),
                'bathrooms' => fake()->numberBetween(1, 4),
                'area_sqm' => fake()->numberBetween(50, 500),
                'parking' => fake()->boolean(),
            ],
            'status' => PropertyStatus::Draft,
            'published_at' => null,
            'is_featured' => false,
            'view_count' => fake()->numberBetween(0, 500),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PropertyStatus::Published,
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    public function status(PropertyStatus $status): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $status,
            'published_at' => $status === PropertyStatus::Published
                ? ($attributes['published_at'] ?? now())
                : $attributes['published_at'],
        ]);
    }

    public function disabled(): static
    {
        return $this->status(PropertyStatus::Disabled);
    }

    public function deleted(): static
    {
        return $this->status(PropertyStatus::Deleted);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function withOptions(array $options): static
    {
        return $this->state(fn (array $attributes) => [
            'options' => array_merge($attributes['options'] ?? [], $options),
        ]);
    }
}
