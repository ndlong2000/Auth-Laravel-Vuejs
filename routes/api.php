<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function (Request $request) {
    return true;
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
});
Route::post('products/search', [\App\Http\Controllers\ProductController::class,'search']);

Route::post('register', [\App\Http\Controllers\AuthController::class,'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
