<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\FormattedResponsesTrait;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Exceptions\CreateResourceException;
use App\Exceptions\ReadResourceException;
use App\Exceptions\UpdateResourceException;
use App\Exceptions\DeleteResourceException;

/**
 * Class TaskController
 *
 * @package App\Http\Controllers\API
 */
class TaskController extends Controller
{
    use FormattedResponsesTrait;

    /** @var TaskService */
    private TaskService $taskService;

    /**
     * RoleController constructor.
     *
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
        $this->authorizeResource(Task::class);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Display a listing of the tasks.",
     *     tags={"Roles"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Task")
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
            return (TaskResource::collection($this->taskService->index()))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Store a newly created task in storage.",
     *     tags={"Roles"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateTaskRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to create resource"
     *     )
     * )
     * @param CreateTaskRequest $request
     *
     * @return JsonResponse
     *
     * @throws CreateResourceException
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        try {
            return (new TaskResource($this->taskService->store($request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);

        } catch (\Exception $e) {
            throw new CreateResourceException();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Display the specified task.",
     *     tags={"Task"},
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
     *         description="Task not found"
     *     )
     * )
     * @param Task $task
     *
     * @return JsonResponse
     *
     * @throws ReadResourceException
     */
    public function show(Task $task): JsonResponse
    {
        try {
            return (new TaskResource($this->taskService->show($task->id)))
                ->response()
                ->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Update the specified task in storage.",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateTaskRequest")
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Task updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to update resource"
     *     )
     * )
     * @param UpdateTaskRequest $request
     * @param Task $task
     *
     * @return JsonResponse
     *
     * @throws UpdateResourceException
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        try {
            return (new TaskResource($this->taskService->update($task['id'], $request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);

        } catch (\Exception $e) {
            throw new UpdateResourceException();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Remove the specified task from storage.",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully",
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
     *                 example="Task successfully deleted."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to delete resource"
     *     )
     * )
     * @param Task $task
     *
     * @return JsonResponse
     *
     * @throws DeleteResourceException
     */
    public function destroy(Task $task): JsonResponse
    {
        try {
            $this->taskService->delete($task->id);

            return response()->json(['success' => true, 'message' => 'Task successfully deleted.']);
        } catch (\Exception $e) {
            throw new DeleteResourceException();
        }
    }
}
