<?php

namespace Database\Factories;

use App\Enums\Priorities;
use App\Enums\Roles;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $roles = [
            Roles::ADMIN,
            Roles::CLIENT,
            Roles::CANDIDATE
        ];

        $rolesTypes = fake()->unique()->randomElement($roles);

        return [
            'role' => $rolesTypes,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
