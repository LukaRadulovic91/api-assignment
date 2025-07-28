<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class CandidateSeeder
 *
 * @package Database\Seeders
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            Roles::ADMIN,
            Roles::CLIENT,
            Roles::CANDIDATE
        ];

        foreach ($roles as $role) {
            Role::create([
               'role' => Roles::getDescription($role),
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
            ]);
        }
    }
}
