<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function index()
    {
        $barrios = \App\Models\Barrio::all();

        $query = \App\Models\Propiedad::with(['imagenes', 'barrio']);

        $query->whereDoesntHave('solicitudes', function ($q) {
            $q->where('estatus', 'Aceptado');
        });

        $query->whereDoesntHave('pagos', function ($q) {
            $q->whereIn('status', ['pagado', 'pendiente']);
        });

        $resultados = $query->get();

        $cuartos = $resultados->where('tipo', 'cuarto');
        $casas = $resultados->where('tipo', 'casa');
        $departamentos = $resultados->where('tipo', 'departamento');

        return view('inquilino.index', compact('barrios', 'cuartos', 'casas', 'departamentos'));
    }

    public function show($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        return view('propietario.propiedades.show', compact('propiedad'));
    }

    public function search(Request $request)
    {
        $query = Propiedad::query();

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->input('tipo'));
        }

        if ($request->filled('barrio_id')) {
            $query->where('barrio_id', $request->input('barrio_id'));
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->input('precio_min'));
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->input('precio_max'));
        }

        if ($request->filled('servicios')) {
            foreach ($request->servicios as $servicio) {
                $query->whereJsonContains('servicios', $servicio);
            }
        }

        $cuartos = (clone $query)->where('tipo', 'cuarto')->get();
        $departamentos = (clone $query)->where('tipo', 'departamento')->get();
        $casas = (clone $query)->where('tipo', 'casa')->get();

        $barrios = Barrio::all();
        


        return view('index', compact('cuartos', 'departamentos', 'casas', 'barrios'));
    }

    public function vermas($id)
    {
        $barrios = Barrio::all();
        $propiedad=Propiedad::findOrFail($id);
        $review = Review::where('propiedad_id', $id)->with('usuario')->get();
        $espropietario = Auth::check() && Auth::user()->role === 'propietario';
        return view('inquilino.vermas', compact('propiedad', 'review', 'barrios', 'espropietario'));
    }
}