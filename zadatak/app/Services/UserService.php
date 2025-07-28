<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserService
 *
 * @package App\Services\Users
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * CommentService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return $this->userRepository->getAll();
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->userRepository->findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function store(array $data): User
    {
        return $this->userRepository->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return User
     */
    public function update(int $id, array $data): User
    {
        return $this->userRepository->update($id, $data);
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
        return $this->userRepository->delete($id);
    }

    /**
     * @param Request $request
     *
     * @return mixed|void
     */
    public function validateDataForUpdatePassword(Request $request)
    {
        return Validator::make($request->all(),
            [
                'current_password' => 'required',
                'new_password' => 'required',
                'new_confirm_password' => 'required|same:new_password'
            ]);
    }

    /**
     * @param string $newPassword
     *
     * @return void
     */
    public function updatePassword(string $newPassword)
    {
        auth()->user()->update([
            'password' => Hash::make($newPassword),
        ]);
    }
}
