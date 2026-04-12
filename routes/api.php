<?php

use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'Users']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/propiedades', [PropiedadController::class, 'Propiedades']);

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::post('/register', [UserController::class, 'register']);



Route::middleware('auth:sanctum')->group(function () {

    Route::post('propiedades/{idPropiedad}/reviews', [ReviewController::class, 'store']);

    Route::apiResource('reviews', ReviewController::class)->except(['store']);
});




