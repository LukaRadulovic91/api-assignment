<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Models\Project;
use App\Services\FormattedResponsesTrait;
use App\Services\ProjectService;
use App\Exceptions\CreateResourceException;
use App\Exceptions\ReadResourceException;
use App\Exceptions\UpdateResourceException;
use App\Exceptions\DeleteResourceException;

/**
 * Class ProjectController
 *
 * @package App\Http\Controllers\API
 */
class ProjectController extends Controller
{
    use FormattedResponsesTrait;

    /** @var ProjectService */
    private ProjectService $projectService;

    /**
     * ProjectController constructor.
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
        $this->authorizeResource(Project::class);
    }

    /**
     * @OA\Get(
     *     path="/api/projects",
     *     summary="Display a listing of the projects.",
     *     tags={"Projects"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Project")
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
            return (ProjectResource::collection($this->projectService->index()))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Post(
     *     path="/api/projects",
     *     summary="Store a newly created project in storage.",
     *     tags={"Projects"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateProjectRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comment created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to create resource"
     *     )
     * )
     * @param CreateProjectRequest $request
     *
     * @return JsonResponse
     *
     * @throws CreateResourceException
     */
    public function store(CreateProjectRequest $request): JsonResponse
    {
        try {
            return (new ProjectResource($this->projectService->store(
                array_merge($request->validated(), ['user_id' => auth()->user()->id])))
            )
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);

        } catch (\Exception $e) {
            throw new CreateResourceException();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/projects/{id}",
     *     summary="Display the specified project.",
     *     tags={"Project"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the project",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Project not found"
     *     )
     * )
     * @param Project $project
     *
     * @return JsonResponse
     *
     * @throws ReadResourceException
     */
    public function show(Project $project): JsonResponse
    {
        try {
            return (new ProjectResource($this->projectService->show($project->id)))
                ->response()
                ->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/projects/{id}",
     *     summary="Update the specified project in storage.",
     *     tags={"Projects"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the project",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCProjectRequest")
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Comment updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to update resource"
     *     )
     * )
     * @param UpdateProjectRequest $request
     * @param Project $project
     *
     * @return JsonResponse
     *
     * @throws UpdateResourceException
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        try {
            return (new ProjectResource($this->projectService->update($project['id'], $request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);

        } catch (\Exception $e) {
            throw new UpdateResourceException();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/projects/{id}",
     *     summary="Remove the specified project from storage.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the project",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Project deleted successfully",
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
     *                 example="Project successfully deleted."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to delete resource"
     *     )
     * )
     * @param Project $project
     *
     * @return JsonResponse
     *
     * @throws DeleteResourceException
     */
    public function destroy(Project $project): JsonResponse
    {
        try {
            $this->projectService->delete($project->id);

            return response()->json(['success' => true, 'message' => 'Project successfully deleted.']);
        } catch (\Exception $e) {
            throw new DeleteResourceException();
        }
    }
}
