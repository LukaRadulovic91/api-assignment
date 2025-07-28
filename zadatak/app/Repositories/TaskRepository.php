<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends AbstractCrudRepository
{
    /**
     * TaskRepository constructor.
     *
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        $this->model = $model;
    }
}
