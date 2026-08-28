<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->city();

        return [
            'country_id' => Country::factory(),
            'parent_id' => null,
            'name' => $name,
            'slug' => Str::slug($name),
            'level' => 1,
        ];
    }

    public function level(int $level): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => $level,
        ]);
    }

    public function childOf(Location|int|null $parent = null): static
    {
        return $this->state(function (array $attributes) use ($parent) {
            $parentModel = $parent instanceof Location
                ? $parent
                : ($parent ? Location::find($parent) : Location::factory()->create());

            return [
                'country_id' => $parentModel ? $parentModel->country_id : $attributes['country_id'],
                'parent_id' => $parentModel?->id,
                'level' => $parentModel ? $parentModel->level + 1 : $attributes['level'],
            ];
        });
    }

    public function stateRegion(): static
    {
        $name = fake()->unique()->state();

        return $this->state(fn (array $attributes) => [
            'name' => $name,
            'slug' => Str::slug($name),
            'level' => 1,
            'parent_id' => null,
        ]);
    }

    public function city(?Location $parentState = null): static
    {
        $name = fake()->unique()->city();

        return $this->state(function (array $attributes) use ($parentState, $name) {
            $parent = $parentState ?? Location::factory()->stateRegion()->create();

            return [
                'name' => $name,
                'slug' => Str::slug($name),
                'country_id' => $parent->country_id,
                'parent_id' => $parent->id,
                'level' => 2,
            ];
        });
    }

    public function neighborhood(?Location $parentCity = null): static
    {
        $name = fake()->streetName();

        return $this->state(function (array $attributes) use ($parentCity, $name) {
            $parent = $parentCity ?? Location::factory()->city()->create();

            return [
                'name' => $name,
                'slug' => Str::slug($name),
                'country_id' => $parent->country_id,
                'parent_id' => $parent->id,
                'level' => 3,
            ];
        });
    }
}
