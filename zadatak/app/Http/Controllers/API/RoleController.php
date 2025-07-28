<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\CreateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\FormattedResponsesTrait;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Exceptions\CreateResourceException;
use App\Exceptions\ReadResourceException;
use App\Exceptions\UpdateResourceException;
use App\Exceptions\DeleteResourceException;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers\API
 */
class RoleController extends Controller
{
    use FormattedResponsesTrait;

    /** @var RoleService */
    private RoleService $roleService;

    /**
     * RoleController constructor.
     *
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->authorizeResource(Role::class);
    }

    /**
     * @OA\Get(
     *     path="/api/roles",
     *     summary="Display a listing of the roles.",
     *     tags={"Roles"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
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
            return (RoleResource::collection($this->roleService->index()))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Post(
     *     path="/api/roles",
     *     summary="Store a newly created role in storage.",
     *     tags={"Roles"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateRoleRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Role created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to create resource"
     *     )
     * )
     * @param CreateRoleRequest $request
     *
     * @return JsonResponse
     *
     * @throws CreateResourceException
     */
    public function store(CreateRoleRequest $request): JsonResponse
    {
        try {
            return (new RoleResource($this->roleService->store($request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);

        } catch (\Exception $e) {
            throw new CreateResourceException();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/roles/{id}",
     *     summary="Display the specified role.",
     *     tags={"Role"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the role",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found"
     *     )
     * )
     * @param Role $role
     *
     * @return JsonResponse
     *
     * @throws ReadResourceException
     */
    public function show(Role $role): JsonResponse
    {
        try {
            return (new RoleResource($this->roleService->show($role->id)))
                ->response()
                ->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/roles/{id}",
     *     summary="Update the specified role in storage.",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the role",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateRoleRequest")
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Role updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to update resource"
     *     )
     * )
     * @param UpdateRoleRequest $request
     * @param Role $role
     *
     * @return JsonResponse
     *
     * @throws UpdateResourceException
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        try {
            return (new RoleResource($this->roleService->update($role['id'], $request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);

        } catch (\Exception $e) {
            throw new UpdateResourceException();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/roles/{id}",
     *     summary="Remove the specified role from storage.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the role",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role deleted successfully",
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
     *                 example="Role successfully deleted."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to delete resource"
     *     )
     * )
     * @param Role $role
     *
     * @return JsonResponse
     *
     * @throws DeleteResourceException
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            $this->roleService->delete($role->id);

            return response()->json(['success' => true, 'message' => 'Role successfully deleted.']);
        } catch (\Exception $e) {
            throw new DeleteResourceException();
        }
    }
}
