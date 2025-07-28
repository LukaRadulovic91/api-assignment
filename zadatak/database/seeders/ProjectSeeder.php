<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

/**
 * Class CandidateSeeder
 *
 * @package Database\Seeders
 */
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory(10)->create();
    }
}
