<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends AbstractCrudRepository
{
    /**
     * TaskRepository constructor.
     *
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
}
