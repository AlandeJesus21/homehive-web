<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}