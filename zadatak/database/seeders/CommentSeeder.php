<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

/**
 * Class CandidateSeeder
 *
 * @package Database\Seeders
 */
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(10)->create();
    }
}
