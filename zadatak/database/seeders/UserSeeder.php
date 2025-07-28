<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Class CandidateSeeder
 *
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
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
            User::create([
                'role_id' => $role,
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'username' => fake()->userName,
                'email' => lcfirst(Roles::getDescription($role)).'@mail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
