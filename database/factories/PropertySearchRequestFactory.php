<?php

namespace Database\Factories;

use App\Models\PropertySearchRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertySearchRequest>
 */
class PropertySearchRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mobileNumber = '+22177' . fake()->unique()->randomNumber(7);

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'mobile_number' => $mobileNumber,
            'mobile_number_country' => 'SN',
            'email' => fake()->unique()->safeEmail(),
            'category_id' => Category::factory(),
            'location_id' => Location::factory(),
            'options' => [
                'min_bedrooms' => fake()->numberBetween(1, 3),
                'min_bathrooms' => fake()->numberBetween(1, 2),
                'min_area_sqm' => fake()->numberBetween(60, 150),
                'has_parking' => fake()->boolean(),
            ],
            'message' => fake()->optional(0.7)->paragraph(),
            'budget' => fake()->randomFloat(2, 100000, 800000),
        ];
    }

    public function withBudget(float $budget): static
    {
        return $this->state(fn (array $attributes) => [
            'budget' => $budget,
        ]);
    }

    public function withOptions(array $options): static
    {
        return $this->state(fn (array $attributes) => [
            'options' => array_merge($attributes['options'] ?? [], $options),
        ]);
    }

    public function forTarget(?Category $category = null, ?Location $location = null): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $category?->id ?? Category::factory(),
            'location_id' => $location?->id ?? Location::factory(),
        ]);
    }
}
