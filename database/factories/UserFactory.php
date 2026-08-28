<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mobileNumber = '+22177' . fake()->unique()->randomNumber(7);

        return [
            'role_id' => Role::factory(),

            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),

            'mobile_number' => $mobileNumber,
            'mobile_number_country' => 'SN',
            'mobile_number_verification_code' => null,
            'mobile_number_verified_at' => now(),

            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),
            'term_accepted' => true,

            'last_login_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverifiedEmail(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function unverifiedMobile(): static
    {
        return $this->state(fn (array $attributes) => [
            'mobile_number_verified_at' => null,
        ]);
    }

    public function withRole(Role|int $role): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => $role instanceof Role ? $role->id : $role,
        ]);
    }
}
