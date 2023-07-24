<?php

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


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'getUser')->name('resumes');
        Route::get('/{userId}/referees', 'getReferees')->name('api-referees');
    });
});
