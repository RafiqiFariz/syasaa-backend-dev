<?php

use App\Http\Controllers\API\V1\ClassController;
use App\Http\Controllers\API\V1\CourseController;
use App\Http\Controllers\API\V1\FacultyController;
use App\Http\Controllers\API\V1\MajorController;
use App\Http\Controllers\API\V1\PermissionController;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::apiResource('courses', CourseController::class);
        Route::apiResource('classes', ClassController::class);
        Route::apiResource('faculties', FacultyController::class);
        Route::apiResource('majors', MajorController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('users', UserController::class);
    });
});

// Custom route for updating user profile information based on the Fortify route
Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::put('/profile-information', [ProfileInformationController::class, 'update']);
});
