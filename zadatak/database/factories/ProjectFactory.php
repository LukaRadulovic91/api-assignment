<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Enums\Roles;
use App\Enums\Statuses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = [
            Statuses::ACTIVE,
            Statuses::INACTIVE,
        ];

        $statusTypes = fake()->randomElement($statuses);

        return [
            'user_id' => Roles::ADMIN,
            'name' => 'Project '.fake()->word,
            'description' => fake()->text,
            'start_date' => fake()->dateTimeThisYear,
            'end_date' => fake()->dateTimeThisYear,
            'status' => $statusTypes,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
