<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait FormattedResponsesTrait
 *
 * @package App\Services
 */
trait FormattedResponsesTrait
{
    /**
     * @param string $message
     *
     * @return JsonResponse
     */
    public function defaultOkStatusResponse(string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @param Model $model
     * @param string|null $message
     *
     * @return JsonResponse
     */
    public function okStatusResponse(Model $model, string $message = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $model,
            'message' => $message,
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @param string $message
     *
     * @return JsonResponse
     */
    public function unauthorizedStatusResponse(string $message): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     *
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
