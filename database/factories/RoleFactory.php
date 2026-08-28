<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->jobTitle(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Admin',
        ]);
    }

    public function user(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'User',
        ]);
    }

    public function withPermissions(mixed $permissions = 3): static
    {
        return $this->afterCreating(function (Role $role) use ($permissions) {
            if (is_int($permissions)) {
                $permissions = Permission::factory()->count($permissions)->create();
            }

            $role->permissions()->sync($permissions);
        });
    }
}
