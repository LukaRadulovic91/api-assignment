<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentService
 *
 * @package App\Services\Comments
 */
class RoleService
{
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;

    /**
     * CommentService constructor.
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return $this->roleRepository->getAll();
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->roleRepository->findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return Role
     */
    public function store(array $data): Role
    {
        return $this->roleRepository->store($data);
    }

    /**
     * @param array $data
     * @param int $id
     *
     * @return Role
     */
    public function update(int $id, array $data): Role
    {
        return $this->roleRepository->update($id, $data);
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
        return $this->roleRepository->delete($id);
    }
}
