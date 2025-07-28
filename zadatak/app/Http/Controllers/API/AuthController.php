<?php

namespace App\Http\Controllers\API;

use DB;
use Validator;
use JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Support\CustomClaims;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Services\AuthRegisterUserApiTrait;
use App\Services\FormattedResponsesTrait;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isNull;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\API
 */
class AuthController extends Controller
{
    use AuthRegisterUserApiTrait, FormattedResponsesTrait;

    /** @var bool */
    public $token = true;

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remeber_me' => 'nullable|bool',
            'token' => 'nullable|string'
        ]);
        $credentials = $request->only('email', 'password');

        $ttl = $request->has('remember_me') ? env('JWT_REMEMBER_TTL') : config('jwt.ttl');
        $token = JWTAuth::customClaims(['exp' => now()->addMinutes($ttl)->timestamp])->attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function registerUser(Request $request): JsonResponse
    {
        $validator = $this->validateUser($request);

        if ($validator->fails()) {
            return response()
                ->json(array_merge(
                    $validator->errors()->toArray()
                ), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $user = DB::transaction(function () use ($request) {
                return $this->storeUser($request);
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        event(new Registered($user));

        return $this->okStatusResponse($user);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $this->defaultOkStatusResponse('User logged out successfully!');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function checkUniqueEmail(Request $request): JsonResponse
    {
        $email = $request->input('email');

        $emailExists = User::where('email', $email)->first();

        if ($emailExists) {
            return response()->json(['success' => false, 'message' => 'Email already exists.']);
        }

        return response()->json(['success' => true, 'message' => 'Email is available.']);
    }

    /**
     * @param Request $request
     * @param UserService $userService
     *
     * @return JsonResponse
     */
    public function updatePassword(Request $request, UserService $userService)
    {
        $validator = $userService->validateDataForUpdatePassword($request);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->toArray()]);
        }

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return response()->json(['error' => 'The current password is incorrect.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $userService->updatePassword($request->new_password);

        return response()->json(['success' => true, 'message' => 'The password is successfully changed.']);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    private function handleTokenMissmatch(Request $request)
    {
        if (!$this->token) return $this->login($request);
    }
}
