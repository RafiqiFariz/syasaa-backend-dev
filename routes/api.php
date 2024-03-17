<?php

use App\Http\Controllers\API\V1\CourseController;
use App\Http\Controllers\API\V1\PermissionController;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;

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

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('courses', CourseController::class);
    });
});

// Custom route for updating user profile information based on the Fortify route
Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::put('/profile-information', [ProfileInformationController::class, 'update']);
});
