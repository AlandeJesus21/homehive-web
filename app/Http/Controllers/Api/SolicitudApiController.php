<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\Propiedad;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudApiController extends Controller
{
    // 1. Inquilino envía desde Flutter
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
            'user_id'       => $solicitud->user_id, // El inquilino
            'arrendador_id' => Auth::id(),
            'monto'         => $solicitud->precio,
            'fecha_inicio'  => now(),
            'fecha_fin'     => now()->addMonth(),
            'status'        => 'pendiente',
        ]);

        return response()->json([
            'message' => 'Solicitud aceptada. Pago pendiente generado.',
            'pago_id' => $pago->id
        ]);
    }

    public function rechazarApi($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update(['estatus' => 'Rechazado']);
        return response()->json(['message' => 'Solicitud rechazada']);
    }

    public function historialApi()
    {
        $user = Auth::user();
        
        if ($user->rol == 'propietario') {
            // IMPORTANTE: pasamos el $user a la consulta interna
            $solicitudes = Solicitud::whereHas('propiedad', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['aspirante', 'propiedad']) // Cargamos relaciones para que Flutter tenga qué mostrar
            ->latest()
            ->get();
        } else {
            $solicitudes = Solicitud::where('user_id', $user->id)
                ->with('propiedad')
                ->latest()
                ->get();
        }

        return response()->json($solicitudes);
    }
}