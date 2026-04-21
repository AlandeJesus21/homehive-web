<?php

use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\ReseñasController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SolicitudApiController;
use App\Http\Controllers\Api\PagoApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\FcmController;

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
    Route::post('/pagos/checkout/{id}', [PagoApiController::class, 'crearSesionCheckout']);
    Route::get('/pago/exito', function () {
        return "<h1>¡Pago completado con éxito!</h1><p>Ya puedes cerrar esta ventana y regresar a HomeHive.</p>";
    })->name('api.pago.exito');

    Route::get('/pago/cancelado', function () {
        return "<h1>Pago cancelado</h1><p>No se realizó ningún cargo. Puedes intentarlo de nuevo desde la app.</p>";
    })->name('api.pago.cancelado');
    Route::get('/mis-pagos', [PagoApiController::class, 'index']);

    Route::get('/pagos/recibo/{id}', [PagoApiController::class, 'generarReciboApi']);
    
    Route::get('/pagos/contrato/{id}', [PagoApiController::class, 'generarContratoApi']);
});


Route::get('/conversations/{userId}', [ConversationController::class, 'index']);
Route::post('/conversations', [ConversationController::class, 'store']);

Route::get('/messages/{conversationId}', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);


    Route::post('/test-push', [NotificationController::class, 'testPush']);

    Route::post('/fcm-token', [FcmController::class, 'saveFcmToken'])
    ->middleware('auth:sanctum');




