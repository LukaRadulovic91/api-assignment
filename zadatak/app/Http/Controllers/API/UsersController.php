<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Exceptions\ReadResourceException;
use App\Exceptions\UpdateResourceException;
use App\Exceptions\DeleteResourceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FormattedResponsesTrait;
use App\Services\UserService;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\API
 */
class UsersController extends Controller
{
    use FormattedResponsesTrait;

    /** @var UserService */
    private UserService $userService;

    /**
     * RoleController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->authorizeResource(User::class);
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Display a listing of the users.",
     *     tags={"Roles"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to read resources"
     *     )
     * )
     * @throws ReadResourceException
     */
    public function index()
    {
        try {
            return (UserResource::collection($this->userService->index()))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Display the specified user.",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     * @param User $user
     *
     * @return JsonResponse
     *
     * @throws ReadResourceException
     */
    public function show(User $user): JsonResponse
    {
        try {
            return (new UserResource($this->userService->show($user->id)))
                ->response()
                ->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Update the specified user in storage.",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="User updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to update resource"
     *     )
     * )
     * @param UpdateUserRequest $request
     * @param User $user
     *
     * @return JsonResponse
     *
     * @throws UpdateResourceException
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        try {
            return (new UserResource($this->userService->update($user['id'], $request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);

        } catch (\Exception $e) {
            throw new UpdateResourceException();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Remove the specified user from storage.",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User successfully deleted."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to delete resource"
     *     )
     * )
     * @param User $user
     *
     * @return JsonResponse
     *
     * @throws DeleteResourceException
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $this->userService->delete($user->id);

            return response()->json(['success' => true, 'message' => 'User successfully deleted.']);
        } catch (\Exception $e) {
            throw new DeleteResourceException();
        }
    }
}
