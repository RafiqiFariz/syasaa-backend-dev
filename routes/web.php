<?php

use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
