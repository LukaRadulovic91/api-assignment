<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends AbstractCrudRepository
{
    /**
     * TaskRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
