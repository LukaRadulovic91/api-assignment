<?php

namespace Database\Factories;

use App\Enums\Roles;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'task_id' => Task::all()->random()->id,
            'comment_text' => fake()->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
