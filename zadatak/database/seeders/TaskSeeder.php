<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

/**
 * Class CandidateSeeder
 *
 * @package Database\Seeders
 */
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(10)->create();
    }
}
