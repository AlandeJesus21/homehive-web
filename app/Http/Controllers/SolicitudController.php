<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Propiedad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SolicitudController extends Controller
{
    public function index()
    {
        // Obtenemos los datos ordenados por los más recientes
        $solicitudes = Solicitud::latest()->get();

        return view('inquilino.solicitudes', compact('solicitudes'));
    }
    public function solicitarpropiedad($id)
    {

        $propiedad = Propiedad::findOrFail($id);

        return view('inquilino.solicitud', compact('propiedad'));
    }


    public function store(Request $request)

    {
        $datos = $request->validate([
            'titulo' => 'required|string',
            'precio'    => 'required|numeric',
            'curp'      => 'required|string|max:18',
            'edad'      => 'required|integer',
            'ocupacion' => 'required|string',
            'fecha'     => 'required|date',
            'telefono'  => 'required|string',
            'mensaje'   => 'nullable|string',
        ]);

        Solicitud::create([
            'user_id' => Auth::id(),
            'propiedad' => $datos['titulo'],
            'precio'    => $datos['precio'],
            'estatus'   => 'Pendiente',
            'curp'      => $datos['curp'],
            'edad'      => $datos['edad'],
            'ocupacion' => $datos['ocupacion'],
            'fecha'     => $datos['fecha'],
            'telefono'  => $datos['telefono'],
            'mensaje'   => $datos['mensaje'],
        ]);

        return redirect()->route('solicitudes')->with('success', 'Solicitud enviada correctamente');
    }

    public function show($id)
{
    $solicitud = Solicitud::findOrFail($id);
    return view('inquilino.versolicitud', compact('solicitud'));
}
}
