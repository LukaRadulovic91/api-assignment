<?php

use App\Enums\Roles;
use App\Http\Controllers\API\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** part of API auth system */
Route::middleware(['auth:api', 'cors'])->group(function () {

    /** Users routes */
    Route::group(['users'], static function() {
        Route::apiResource('users', '\App\Http\Controllers\API\UsersController');
    });
    /** Users routes */

    /** Roles routes */
    Route::group(['roles'], static function() {
        Route::apiResource('roles', '\App\Http\Controllers\API\RoleController');
    });
    /** Roles routes */

    /** Projects routes */
    Route::group(['projects'], static function() {
        Route::apiResource('projects', '\App\Http\Controllers\API\ProjectController');
    });
    /** Projects routes */

    /** Tasks routes */
    Route::group(['tasks'], static function() {
        Route::apiResource('tasks', '\App\Http\Controllers\API\TaskController');
    });
    /** Tasks routes */

    /** Comments routes */
    Route::group(['comments'], static function() {
        Route::apiResource('comments', '\App\Http\Controllers\API\CommentController');
    });
    /** Comments routes */
});
/** part of API auth system */

Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('api.login');
Route::post('register-user', [\App\Http\Controllers\API\AuthController::class, 'registerUser'])->name('api.register-user');
