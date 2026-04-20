<?php

use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\ReseñasController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SolicitudApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'Users']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/propiedades', [PropiedadController::class, 'propiedades']);
Route::put('/propiedades/{id}', [PropiedadController::class, 'update']);

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



Route::middleware('auth:sanctum')->group(function () {

    Route::post('propiedades/{idPropiedad}/reviews', [ReviewController::class, 'store']);

    Route::apiResource('reviews', ReviewController::class)->except(['store']);

    Route::post('/solicitudes/{id}', [SolicitudApiController::class, 'storeApi']);
    
    Route::post('/solicitudes/{id}/aceptar', [SolicitudApiController::class, 'aceptarApi']);
    Route::post('/solicitudes/{id}/rechazar', [SolicitudApiController::class, 'rechazarApi']);
    
    Route::get('/mis-solicitudes', [SolicitudApiController::class, 'historialApi']);
});


Route::get('/conversations/{userId}', [ConversationController::class, 'index']);
Route::post('/conversations', [ConversationController::class, 'store']);

Route::get('/messages/{conversationId}', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);




