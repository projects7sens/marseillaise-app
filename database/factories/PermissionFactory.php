<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $resource = fake()->randomElement(['users', 'properties', 'roles', 'reports']);
        $action = fake()->randomElement(['index', 'show', 'store', 'update', 'destroy']);

        return [
            'route' => "{$resource}.{$action}",
        ];
    }

    public function route(string $route): static
    {
        return $this->state(fn (array $attributes) => [
            'route' => $route,
        ]);
    }

    public function withRoles(mixed $roles = 1): static
    {
        return $this->afterCreating(function (Permission $permission) use ($roles) {
            if (is_int($roles)) {
                $roles = Role::factory()->count($roles)->create();
            }

            $permission->roles()->sync($roles);
        });
    }
}
