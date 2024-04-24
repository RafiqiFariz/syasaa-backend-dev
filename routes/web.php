<?php

use App\Http\Controllers\API\V1\ProfilePhotoController;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'name' => 'API Web Attendance System',
        'version' => '1.0',
        'description' => 'API Web Attendance System digunakan untuk aplikasi absensi di lingkungan universitas.',
        'documentation' => 'https://documenter.getpostman.com/view/16454761/2sA2xcaF8o',
        'status' => 200,
    ]);
})->name('home');

Route::get('/reset-password/{token}', function ($token) {
    return $token;
})
    ->middleware(['guest:' . config('fortify.guard')])
    ->name('password.reset');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return (new UserResource($request->user()->load('role')))
        ->response()
        ->getData(true)['data'];
});

// Custom route for updating user profile information based on the Fortify route
$fortifyMiddleware = config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard');

Route::group(['prefix' => 'user', 'middleware' => [$fortifyMiddleware]], function () {
    Route::put('/profile-information', [ProfileInformationController::class, 'update'])
        ->name('user-profile-information.update');
    Route::put('/profile-photo', [ProfilePhotoController::class, 'update'])->name('user-profile-photo.update');
    Route::delete('/remove-photo', [ProfilePhotoController::class, 'delete'])->name('user-profile-photo.delete');
});
