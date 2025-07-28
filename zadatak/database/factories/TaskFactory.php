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
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $priorities = [
            Priorities::LOW,
            Priorities::NORMAL,
            Priorities::HIGH
        ];

        $priorityTypes = fake()->randomElement($priorities);

        return [
            'project_id' => Project::all()->random()->id,
            'task_name' => 'Task '.fake()->word,
            'description' => fake()->text,
            'due_date' => fake()->dateTimeThisYear,
            'priority' => $priorityTypes,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
