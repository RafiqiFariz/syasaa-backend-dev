<?php

use App\Http\Controllers\API\V1\AttendanceController;
use App\Http\Controllers\API\V1\AttendanceRequestController;
use App\Http\Controllers\API\V1\ClassController;
use App\Http\Controllers\API\V1\CourseClassController;
use App\Http\Controllers\API\V1\CourseController;
use App\Http\Controllers\API\V1\FacultyController;
use App\Http\Controllers\API\V1\MajorController;
use App\Http\Controllers\API\V1\PermissionController;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\UpdateProfileRequestController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::apiResource('attendances', AttendanceController::class);
        Route::apiResource('attendance-requests', AttendanceRequestController::class);
        Route::apiResource('courses', CourseController::class);
        Route::apiResource('course-classes', CourseClassController::class);
        Route::apiResource('major-classes', ClassController::class);
        Route::apiResource('faculties', FacultyController::class);
        Route::apiResource('majors', MajorController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('update-profile-requests', UpdateProfileRequestController::class);
        Route::put('update-profile-requests/{update_profile_request}/status',
            [UpdateProfileRequestController::class, 'updateStatus']
        )->name('update-profile-requests.update-status');
        Route::put('attendance-requests/{attendance_request}/status',
            [AttendanceRequestController::class, 'updateStatus']
        )->name('attendance-requests.update-status');
    });
});
