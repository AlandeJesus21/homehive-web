<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoApiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $query = Pago::with(['propiedad', 'inquilino', 'arrendador'])
            ->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('arrendador_id', $user->id);
            });

        if ($request->has('desde') && $request->has('hasta')) {
            $query->whereDate('created_at', '>=', $request->desde)
                ->whereDate('created_at', '<=', $request->hasta);
        }

        $pagos = $query->orderBy('created_at', 'desc')->get();

        return response()->json($pagos);
    }

    public function generarReciboApi(Request $request, $id)
    {
        if ($request->has('token')) {
            $request->headers->set('Authorization', 'Bearer ' . $request->token);
        }

        $user = auth('sanctum')->user();

        $pago = Pago::with(['propiedad', 'inquilino', 'arrendador'])
                    ->where('id', $id)
                    ->where(function($query) use ($user) {
                        $query->where('user_id', $user->id)
                              ->orWhere('arrendador_id', $user->id);
                    })
                    ->first();

        if (!$pago) {
            return response()->json(['error' => 'Recibo no encontrado o no tienes permiso'], 404);
        }

        $request->merge(['download' => 1]);

        $pdf = Pdf::loadView('pdf.recibo', compact('pago'));
        return $pdf->stream('recibo_homehive_'.$id.'.pdf');
    }

    public function generarContratoApi(Request $request, $id)
    {
        if ($request->has('token')) {
            $request->headers->set('Authorization', 'Bearer ' . $request->token);
        }

        $user = auth('sanctum')->user();

        $pago = Pago::with(['propiedad.barrio', 'inquilino', 'arrendador'])
                    ->where('id', $id)
                    ->where(function($query) use ($user) {
                        $query->where('user_id', $user->id)
                              ->orWhere('arrendador_id', $user->id);
                    })
                    ->first();

        if (!$pago) {
            return response()->json(['error' => 'Contrato no encontrado'], 404);
        }

        $request->merge(['download' => 1]);

        $pdf = Pdf::loadView('pdf.contrato', compact('pago'));

        return $pdf->stream('contrato_homehive_'.$id.'.pdf');
    }
    
    public function crearSesionCheckout(Request $request, $id)
    {
        $user = auth()->user();

        $solicitud = \App\Models\Solicitud::with('propiedad')->find($id);

        if (!$solicitud) {
            return response()->json(['error' => 'La solicitud no existe en la base de datos.'], 404);
        }

        $pago = Pago::where('status', 'pendiente')
                    ->where('user_id', $user->id)
                    ->where('propiedad_id', $solicitud->propiedad_id)
                    ->first();

        if (!$pago) {
            $pago = Pago::create([
                'propiedad_id'  => $solicitud->propiedad_id,
                'user_id'       => $user->id,
                'arrendador_id' => $solicitud->propiedad->user_id,
                'monto'         => $solicitud->precio,
                'status'        => 'pendiente',
            ]);
        }

        try {
            $checkout = $user->checkoutCharge(
                $pago->monto * 100,
                "Renta HomeHive: " . ($solicitud->propiedad->titulo ?? 'Propiedad'), 
                1, 
                [
                    'success_url' => route('api.pago.exito'), 
                    'cancel_url' => route('api.pago.cancelado'),
                    'metadata' => [
                        'pago_id' => $pago->id
                    ]
                ]
            );

            return response()->json(['url' => $checkout->url], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}