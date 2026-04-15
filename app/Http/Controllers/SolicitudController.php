<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $query = Solicitud::with(['propiedad', 'aspirante'])
            ->whereHas('propiedad', function ($q) {
                $q->where('user_id', Auth::id()); // Solo solicitudes de mis propiedades
            });

        // Filtro: fecha desde
        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        // Filtro: fecha hasta
        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')
                             ->paginate(10)
                             ->withQueryString();

        return view('propietario.solicitudes.index', compact('solicitudes'));
    }


    public function historial(Request $request)
    {
        // $query = Solicitud::with(['propiedad', 'aspirante'])
        //     ->whereHas('propiedad', function ($q) {
        //         $q->where('user_id', Auth::id()); // Solo solicitudes de mis propiedades
        //     });

        // // Filtro: fecha desde
        // if ($request->filled('desde')) {
        //     $query->whereDate('created_at', '>=', $request->desde);
        // }

        // // Filtro: fecha hasta
        // if ($request->filled('hasta')) {
        //     $query->whereDate('created_at', '<=', $request->hasta);
        // }

        // $solicitudes = $query->orderBy('created_at', 'desc')
        //                      ->paginate(10)
        //                      ->withQueryString();
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
        $datos =$request->validate([
            'titulo'    => 'required|string',
            'precio'    => 'required|numeric',
            'curp'      => 'required|string|max:18',
            'edad'      => 'required|integer',
            'ocupacion' => 'required|string',
            'fecha'     => 'required|date',
            'telefono'  => 'required|string',
            'mensaje'   => 'nullable|string',
        ]);

        Solicitud::create([
            'user_id'   => auth()->id(),
            'propiedad' => $request->titulo,
            'precio'    => $request->precio,
            'estatus'   => 'Pendiente',
            'curp'      => $request->curp,
            'edad'      => $request->edad,
            'ocupacion' => $request->ocupacion,
            'fecha'     => $request->fecha,
            'telefono'  => $request->telefono,
            'mensaje'   => $request->mensaje,
        ]);

        return redirect()->route('solicitudes')->with('success', 'Solicitud enviada correctamente');
    }

    public function show($id)
{
    $solicitud = Solicitud::findOrFail($id);
    return view('inquilino.versolicitud', compact('solicitud'));
}
}
