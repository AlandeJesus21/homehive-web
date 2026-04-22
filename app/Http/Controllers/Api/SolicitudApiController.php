<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\Propiedad;
use App\Models\Pago;
use App\Services\FirebaseService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudApiController extends Controller
{
    public function storeApi(Request $request, $id)
    {
        $request->validate([
            'curp'      => 'required|string|max:18',
            'edad'      => 'required|integer',
            'ocupacion' => 'required|string',
            'fecha'     => 'required|date',
            'telefono'  => 'required|string',
        ]);

        $propiedad = Propiedad::findOrFail($id);

        $solicitud = Solicitud::create([
            'user_id'      => Auth::id(),
            'propiedad_id' => $id,
            'propiedad'    => $propiedad->titulo,
            'precio'       => $propiedad->precio,
            'estatus'      => 'Pendiente',
            'curp'         => $request->curp,
            'edad'         => $request->edad,
            'ocupacion'    => $request->ocupacion,
            'fecha'        => $request->fecha,
            'telefono'     => $request->telefono,
            'mensaje'      => $request->mensaje,
        ]);

        $propietario = User::find($propiedad->user_id);

        if ($propietario && $propietario->fcm_token) {
            $firebase->sendNotification(
                $propietario->fcm_token,
                '¡Nueva solicitud recibida!',
                "Tienes una nueva solicitud para '{$propiedad->titulo}'. Revisa los detalles."
            );
        }

        return response()->json([
            'message' => 'Solicitud enviada con éxito',
            'data' => $solicitud
        ], 201);
    }

    public function aceptarApi($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $propiedadReal = Propiedad::findOrFail($solicitud->propiedad_id);

        if ($propiedadReal->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $solicitud->update(['estatus' => 'Aceptado']);

        $pago = Pago::create([
            'propiedad_id'  => $solicitud->propiedad_id,
            'user_id'       => $solicitud->user_id,
            'arrendador_id' => Auth::id(),
            'monto'         => $solicitud->precio,
            'fecha_inicio'  => now(),
            'fecha_fin'     => now()->addMonth(),
            'status'        => 'pendiente',
        ]);

        $user = User::find($solicitud->user_id);
        if ($user && $user->fcm_token) {
            $firebase->sendNotification(
                $user->fcm_token,
                '¡Solicitud Aceptada!',
                "Tu solicitud para '{$solicitud->propiedad}' ha sido aceptada. Se ha generado un registro de pago."
            );
        }

        return response()->json([
            'message' => 'Solicitud aceptada con éxito.',
            'pago_id' => $pago->id
        ], 200);
    }

    public function rechazarApi($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $propiedadReal = Propiedad::findOrFail($solicitud->propiedad_id);

        if ($propiedadReal->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $solicitud->update(['estatus' => 'Rechazado']);

        $user = User::find($solicitud->user_id);
        if ($user && $user->fcm_token) {
            $firebase->sendNotification(
                $user->fcm_token,
                '¡Solicitud Rechazada!',
                "Tu solicitud para '{$solicitud->propiedad}' ha sido rechazada."
            );
        }

        return response()->json([
            'message' => 'La solicitud ha sido rechazada.'
        ], 200);
    }

    public function historialApi(Request $request)
    {
        $user = Auth::user();
        $desde = $request->query('desde');
        $hasta = $request->query('hasta');

        $query = Solicitud::with(['aspirante', 'propiedad']);

        if ($user->role == 'propietario') {
            $query->whereHas('propiedad', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } else {
            $query->where('user_id', $user->id);
        }

        if ($desde && $hasta) {
            $query->whereDate('created_at', '>=', $desde)
                ->whereDate('created_at', '<=', $hasta);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')->get();

        return response()->json($solicitudes);
    }
}