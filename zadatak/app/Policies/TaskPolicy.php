<?php

namespace App\Policies;

use App\Enums\Roles;
use App\Models\Task;
use App\Models\User;

/**
 * Class TaskPolicy
 *
 * @package App\Policies
 */
class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role_id === Roles::ADMIN || $user->role_id === Roles::CLIENT;
    }

    /**
     * Determine whether the user can update the model.
     * @param User $user
     * @param Task $candidate
     *
     * @return bool
     */
    public function update(User $user, Task $candidate): bool
    {
        return $user->role_id === Roles::ADMIN || $user->role_id === Roles::CLIENT;
    }

    /**
     * Determine whether the user can delete the model.
     * @param User $user
     * @param Task $candidate
     *
     * @return bool
     */
    public function delete(User $user, Task $candidate): bool
    {
        return $user->role_id === Roles::ADMIN;
    }

}
