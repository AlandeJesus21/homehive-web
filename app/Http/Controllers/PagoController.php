<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pago::with(['propiedad', 'inquilino'])
            ->where('arrendador_id', Auth::id()); 

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pagos = $query->orderBy('created_at', 'desc')
                       ->paginate(10)
                       ->withQueryString(); 

        return view('propietario.pagos.index', compact('pagos'));
    }
    public function checkout($id)
    {
        $pago = \App\Models\Pago::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->where('status', 'pendiente')
                    ->firstOrFail();

        return auth()->user()->checkoutCharge(
            $pago->monto * 100, 
            "Pago de Renta - " . ($pago->propiedad->titulo ?? 'Propiedad'), 
            1, 
            [
                'success_url' => route('pagos', ['success' => 1]), 
                'cancel_url' => route('pagos', ['canceled' => 1]),
                'metadata' => [
                    'pago_id' => $pago->id
                ]
            ]
        );
    }

    public function descargarRecibo($id)
    {
        // Buscamos el pago asegurando que el usuario logueado sea el inquilino o el arrendador
        $pago = Pago::with(['propiedad', 'inquilino', 'arrendador'])
                    ->where('id', $id)
                    ->where('status', 'pagado')
                    ->where(function($query) {
                        $query->where('user_id', auth()->id())
                            ->orWhere('arrendador_id', auth()->id());
                    })
                    ->firstOrFail();

        $pdf = Pdf::loadView('pdf.recibo', compact('pago'));
        
       return $pdf->stream('recibo-pago-'.$pago->id.'.pdf');
    }
}