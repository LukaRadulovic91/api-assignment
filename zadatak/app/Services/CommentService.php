<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentService
 *
 * @package App\Services\Comments
 */
class CommentService
{
    /**
     * @var CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * CommentService constructor.
     *
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return $this->commentRepository->getAll();
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->commentRepository->findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return Comment
     */
    public function store(array $data): Comment
    {
        return $this->commentRepository->store($data);
    }

    /**
     * @param array $data
     * @param int $id
     *
     * @return Comment
     */
    public function update(int $id, array $data): Comment
    {
        return $this->commentRepository->update($id, $data);
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
        return $this->commentRepository->delete($id);
    }
}
