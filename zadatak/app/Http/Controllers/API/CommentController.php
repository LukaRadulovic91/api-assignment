<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\FormattedResponsesTrait;
use App\Exceptions\CreateResourceException;
use App\Exceptions\ReadResourceException;
use App\Exceptions\UpdateResourceException;
use App\Exceptions\DeleteResourceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\CreateCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;
use App\Http\Resources\CommentResource;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\API
 */
class CommentController extends Controller
{
    use FormattedResponsesTrait;

    /** @var CommentService */
    private CommentService $commentService;

    /**
     * CommentController constructor.
     *
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->authorizeResource(Comment::class);
    }

    /**
     * @OA\Get(
     *     path="/api/comments",
     *     summary="Display a listing of the comments.",
     *     tags={"Comments"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Comment")
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
            return (CommentResource::collection($this->commentService->index()))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Post(
     *     path="/api/comments",
     *     summary="Store a newly created comment in storage.",
     *     tags={"Comments"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateCommentRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comment created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to create resource"
     *     )
     * )
     * @param CreateCommentRequest $request
     *
     * @return JsonResponse
     *
     * @throws CreateResourceException
     */
    public function store(CreateCommentRequest $request): JsonResponse
    {
        try {
            return (new CommentResource($this->commentService->store(
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
     *     path="/api/comments/{id}",
     *     summary="Display the specified comment.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the comment",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     * @param Comment $comment
     *
     * @return JsonResponse
     *
     * @throws ReadResourceException
     */
    public function show(Comment $comment): JsonResponse
    {
        try {
            return (new CommentResource($this->commentService->show($comment->id)))
                ->response()
                ->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $e) {
            throw new ReadResourceException();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     summary="Update the specified comment in storage.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the comment",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCommentRequest")
     *     ),
     *     @OA\Response(
     *         response=202,
     *         description="Comment updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to update resource"
     *     )
     * )
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     *
     * @return JsonResponse
     *
     * @throws UpdateResourceException
     */
    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        try {
            return (new CommentResource($this->commentService->update($comment['id'], $request->validated())))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);

        } catch (\Exception $e) {
            throw new UpdateResourceException();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     summary="Remove the specified comment from storage.",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the comment",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment deleted successfully",
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
     *                 example="Comment successfully deleted."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Failed to delete resource"
     *     )
     * )
     * @param Comment $comment
     *
     * @return JsonResponse
     *
     * @throws DeleteResourceException
     */
    public function destroy(Comment $comment): JsonResponse
    {
        try {
            $this->commentService->delete($comment->id);

            return response()->json(['success' => true, 'message' => 'Comment successfully deleted.']);
        } catch (\Exception $e) {
            throw new DeleteResourceException();
        }
    }
}
