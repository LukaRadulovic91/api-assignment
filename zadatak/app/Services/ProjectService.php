<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

/**
 * Class CommentService
 *
 * @package App\Services\Comments
 */
class ProjectService
{
    /**
     * @var ProjectRepository
     */
    private ProjectRepository $projectRepository;

    /**
     * CommentService constructor.
     *
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return $this->projectRepository->getAll();
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->projectRepository->findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return Project
     */
    public function store(array $data): Project
    {
        return $this->projectRepository->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return Project
     */
    public function update(int $id, array $data): Project
    {
        return $this->projectRepository->update($id, $data);
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
        return $this->projectRepository->delete($id);
    }
}
