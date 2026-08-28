<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'type' => fake()->randomElement(['text', 'number', 'select', 'checkbox', 'radio']),
            'unit' => fake()->optional()->randomElement(['sqft', 'sqm', 'rooms', 'beds', 'baths', 'USD']),
            'values' => null,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function select(array $values = ['Option 1', 'Option 2', 'Option 3']): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'select',
            'values' => $values,
        ]);
    }

    public function checkbox(array $values = ['Feature A', 'Feature B', 'Feature C']): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'checkbox',
            'values' => $values,
        ]);
    }

    public function number(string $unit = 'sqm'): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'number',
            'unit' => $unit,
            'values' => null,
        ]);
    }

    public function withCategories(mixed $categories = 1, bool $required = false): static
    {
        return $this->afterCreating(function (Option $option) use ($categories, $required) {
            if (is_int($categories)) {
                $categories = Category::factory()->count($categories)->create();
            }

            $order = 1;
            foreach ($categories as $category) {
                $option->categories()->attach($category->id, [
                    'required' => $required,
                    'sort_order' => $order++,
                ]);
            }
        });
    }
}
