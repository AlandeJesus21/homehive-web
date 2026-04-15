<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    // 1. Método para mostrar el formulario (EL QUE TE DABA EL ERROR)
    public function solicitarpropiedad($id)
    {
        // Buscamos la propiedad para que la vista tenga el título, precio, etc.
        $propiedad = Propiedad::findOrFail($id);
        
        // Retorna la vista donde está tu formulario
        return view('inquilino.solicitud', compact('propiedad'));
    }

    // 2. Método para guardar la solicitud en la BD
    public function store(Request $request)
    {
        $request->validate([
            'propiedad_id' => 'required',
            'titulo'       => 'required',
            'precio'       => 'required',
            'curp'         => 'required|string|max:18',
            'edad'         => 'required|integer',
            'ocupacion'    => 'required|string',
            'fecha'        => 'required|date',
            'telefono'     => 'required',
        ]);

        Solicitud::create([
            'user_id'      => Auth::id(),
            'propiedad_id' => $request->propiedad_id, // El que agregaste por terminal
            'propiedad'    => $request->titulo,
            'precio'       => $request->precio,
            'curp'         => $request->curp,
            'edad'         => $request->edad,
            'ocupacion'    => $request->ocupacion,
            'fecha'        => $request->fecha,
            'telefono'     => $request->telefono,
            'mensaje'      => $request->mensaje,
            'estatus'      => 'Pendiente',
        ]);

        return redirect()->route('solicitudes')->with('success', 'Solicitud enviada con éxito');
    }

    // 3. Tu método index original (Para que el dueño vea las solicitudes)
    public function index(Request $request)
    {
        $query = Solicitud::with(['aspirante'])
            ->whereHas('datosPropiedad', function ($q) { // Cambié esto a la relación del modelo
                $q->where('user_id', Auth::id()); 
            });

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')
                             ->paginate(10)
                             ->withQueryString();

        return view('propietario.solicitudes.index', compact('solicitudes'));
    }
}