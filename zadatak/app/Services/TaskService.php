<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

/**
 * Class CommentService
 *
 * @package App\Services\Comments
 */
class TaskService
{
    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * CommentService constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return $this->taskRepository->getAll();
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->taskRepository->findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return Task
     */
    public function store(array $data): Task
    {
        return $this->taskRepository->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Task
     */
    public function update(int $id, array $data): Task
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * @param int $id
     *
     * @return null
     *
     * @throws \Exception
     */
    public function delete(int $id): null
    {
        return $this->taskRepository->delete($id);
    }
}
