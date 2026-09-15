<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
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
            'parent_id' => null,
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => fake()->optional()->sentence(),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function childOf(Category|int|null $parent = null): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parent instanceof Category
                ? $parent->id
                : ($parent ?? Category::factory()),
        ]);
    }

    public function withOptions(mixed $options = 2, bool $required = false): static
    {
        return $this->afterCreating(function (Category $category) use ($options, $required) {
            if (is_int($options)) {
                $options = Option::factory()->count($options)->create();
            }

            $order = 1;
            foreach ($options as $option) {
                $category->options()->attach($option->id, [
                    'is_required' => $required,
                    'sort_order' => $order++,
                ]);
            }
        });
    }
}
