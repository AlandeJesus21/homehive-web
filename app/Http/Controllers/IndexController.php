<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class IndexController extends Controller
{
    public function index() 
    {
        $barrios = Barrio::all();
        $cuartos = Propiedad::where('tipo', 'cuarto')->get();
        $casas = Propiedad::where('tipo', 'casa')->get();
        $departamentos = Propiedad::where('tipo', 'departamento')->get();

        return view('index', compact('barrios', 'cuartos', 'casas', 'departamentos'));
    }

    public function show($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        return view('propiedad.show', compact('propiedad'));
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
        $propiedad = $query->get();

        $resultado = $query->get();

        $cuartos = (clone $query)->where('tipo', 'cuarto')->get();
        $departamentos = (clone $query)->where('tipo', 'departamento')->get();
        $casas = (clone $query)->where('tipo', 'casa')->get();

        $barrios = Barrio::all();

        return view('index', compact('cuartos', 'departamentos', 'casas', 'barrios'));
    }
}