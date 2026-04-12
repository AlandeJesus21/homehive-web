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
            ->whereHas('propiedad', function ($q) {
                $q->where('user_id', Auth::id()); // solo pagos de sus propiedades
            });

        //Filtro: fecha desde
        if ($request->filled('desde')) {
            $query->whereDate('fecha_pago', '>=', $request->desde);
        }

        // Filtro: fecha hasta
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_pago', '<=', $request->hasta);
        }

        // (opcional) filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $pagos = $query->orderBy('fecha_pago', 'desc')
                       ->paginate(10)
                       ->withQueryString(); // mantiene filtros en paginación

        return view('propietario.pagos.index', compact('pagos'));
    }
}