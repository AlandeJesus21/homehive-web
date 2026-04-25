<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\ReseñasController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SolicitudApiController;
use App\Http\Controllers\Api\PagoApiController;
use App\Http\Controllers\Api\FavoritosController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\FcmController;

/*
| RUTAS PÚBLICAS (sin autenticación)
*/

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/users', [UserController::class, 'Users']);

Route::get('/propiedades', [PropiedadController::class, 'propiedades']);
Route::get('/vermas/{id}', [PropiedadController::class, 'vermas']);

Route::get('/reseñas/{propiedad_id?}', [ReseñasController::class, 'view']);

/*
| RUTAS PROTEGIDAS (requieren token Sanctum)
*/

Route::middleware('auth:sanctum')->group(function () {

    // Usuario autenticado actual
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Auth
    Route::post('/logout', [UserController::class, 'logout']);

    // Propiedades
    Route::put('/propiedades/{id}', [PropiedadController::class, 'update']);
    Route::delete('/propiedades/{id}', [PropiedadController::class, 'destroy']);
    Route::get('/propiedades/user', [PropiedadController::class, 'getbyuser']);

    // Reseñas (crear/editar/eliminar protegidas)
    Route::post('/reseñas', [ReseñasController::class, 'pubrese']);
    Route::put('/reseñas/{id}', [ReseñasController::class, 'update']);
    Route::delete('/reseñas/{id}', [ReseñasController::class, 'destroy']);

    // Reviews resource
    Route::post('/propiedades/{idPropiedad}/reviews', [ReviewController::class, 'store']);
    Route::apiResource('reviews', ReviewController::class)->except(['store']);

    // Solicitudes
    Route::post('/solicitudes/{id}', [SolicitudApiController::class, 'storeApi']);
    Route::post('/solicitudes/{id}/aceptar', [SolicitudApiController::class, 'aceptarApi']);
    Route::post('/solicitudes/{id}/rechazar', [SolicitudApiController::class, 'rechazarApi']);
    Route::get('/mis-solicitudes', [SolicitudApiController::class, 'historialApi']);

    // Pagos
    Route::post('/pagos/checkout/{id}', [PagoApiController::class, 'crearSesionCheckout']);
    Route::get('/mis-pagos', [PagoApiController::class, 'index']);
    Route::get('/pagos/recibo/{id}', [PagoApiController::class, 'generarReciboApi']);
    Route::get('/pagos/contrato/{id}', [PagoApiController::class, 'generarContratoApi']);

    // Favoritos
    Route::post('/favoritos', [FavoritosController::class, 'store']);
    Route::get('/favoritos', [FavoritosController::class, 'index']);
    Route::delete('/favoritos/{propiedad_id}', [FavoritosController::class, 'destroy']);

    // Mensajería (yo sí la protegería)
    Route::get('/conversations/{userId}', [ConversationController::class, 'index']);
    Route::post('/conversations', [ConversationController::class, 'store']);

    Route::get('/messages/{conversationId}', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);

    // Push / FCM
    Route::post('/test-push', [NotificationController::class, 'testPush']);
    Route::post('/fcm-token', [FcmController::class, 'saveFcmToken']);

    // Estas pueden quedar protegidas si deben requerir sesión
    Route::get('/pago/exito', function () {
        return response()->json([
            'res' => true,
            'message' => '¡Pago completado con éxito!'
        ]);
    })->name('api.pago.exito');

    Route::get('/pago/cancelado', function () {
        return response()->json([
            'res' => false,
            'message' => 'Pago cancelado'
        ]);
    })->name('api.pago.cancelado');

});