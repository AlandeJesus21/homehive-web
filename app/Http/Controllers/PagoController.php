<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function misPagos()
    {
        $pagos = Pago::with('propiedad')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('inquilino.mispagos', compact('pagos'));
    }

    public function checkout($id)
    {
        $pago = Pago::where('id', $id)
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

    public function descargarRecibo($id, Request $request)
    {
        $pago = Pago::with(['propiedad', 'inquilino', 'arrendador'])
                    ->where('id', $id)
                    ->where('status', 'pagado')
                    ->where(function($query) {
                        $query->where('user_id', auth()->id())
                            ->orWhere('arrendador_id', auth()->id());
                    })
                    ->firstOrFail();

        if ($request->has('download')) {
            $pdf = Pdf::loadView('pdf.recibo', compact('pago'));
            return $pdf->download('recibo-pago-'.$pago->id.'.pdf');
        }

        return view('pdf.recibo', compact('pago'));
    }

    public function descargarContrato($id)
    {
        $pago = Pago::with(['propiedad.barrio', 'inquilino', 'arrendador'])
                    ->where('id', $id)
                    ->where('status', 'pagado')
                    ->where(function($query) {
                        $query->where('user_id', auth()->id())
                            ->orWhere('arrendador_id', auth()->id());
                    })
                    ->firstOrFail();

        $pdf = Pdf::loadView('pdf.contrato', compact('pago'));
        
        return $pdf->download('contrato-arrendamiento-'.$pago->id.'.pdf');
    }
}