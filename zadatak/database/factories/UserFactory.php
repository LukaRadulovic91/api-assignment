<?php

namespace Database\Factories;

use App\Enums\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = [
            Roles::ADMIN,
            Roles::CLIENT,
            Roles::CANDIDATE
        ];

        $emails = [
            'mail1@mail.com',
            'mail2@mail.com',
            'mail3@mail.com'
        ];

        $rolesTypes = fake()->unique()->randomElement($roles);
        $emailsTypes = fake()->unique()->randomElement($emails);

        return [
            'role_id' => $rolesTypes,
            'first_name' => 'Luka',
            'last_name' => 'Radulovic',
            'username' => fake()->userName,
            'email' => $emailsTypes,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
