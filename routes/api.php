<?php

use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\ReseñasController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'Users']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/propiedades', [PropiedadController::class, 'propiedades']);
Route::middleware('auth:sanctum')->get(
    '/propiedades/user',
    [PropiedadController::class, 'getbyuser']
);
Route::get('/vermas/{id}', [PropiedadController::class, 'vermas']);


Route::get('reseñas/{propiedad_id?}', [ReseñasController::class, 'view']);
Route::post('reseñas', [ReseñasController::class, 'pubrese']);
Route::put('reseñas/{id}', [ReseñasController::class, 'update']);
Route::delete('reseñas/{id}', [ReseñasController::class, 'destroy']);



Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::post('/register', [UserController::class, 'register']);