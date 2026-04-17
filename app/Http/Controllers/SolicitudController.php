<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Propiedad;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $query = Solicitud::with(['propiedad', 'aspirante'])
            ->whereHas('propiedad', function ($q) {
                $q->where('user_id', Auth::id()); 
            });

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('propietario.solicitudes.index', compact('solicitudes'));
    }

    public function verDetalle($id)
    {
        $solicitud = Solicitud::with(['propiedad', 'aspirante'])->findOrFail($id);

        return view('propietario.solicitudes.show', compact('solicitud'));
    }

    public function aceptar($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $propiedadReal = Propiedad::findOrFail($solicitud->propiedad_id);

        $solicitud->update(['estatus' => 'Aceptado']);

        Pago::create([
            'propiedad_id'  => $solicitud->propiedad_id,
            'user_id'       => $solicitud->user_id,             // Inquilino
            'arrendador_id' => $propiedadReal->user_id,         // Dueño (ahora sí es un objeto)
            'monto'         => $solicitud->precio,
            'fecha_inicio'  => now(),
            'fecha_fin'     => now()->addMonth(),
            'status'        => 'pendiente',
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud aceptada y registro de pago generado.');
    }

    public function rechazar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update(['estatus' => 'Rechazado']);

        return redirect()->back()->with('success', 'La solicitud ha sido rechazada.');
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

    public function store(Request $request, $id)
    {
        $datos =$request->validate([
            'titulo'    => 'required|string',
            'precio'    => 'required|numeric',
            'curp'      => 'required|string|max:18',
            'edad'      => 'required|integer',
            'ocupacion' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'telefono'  => 'required|string',
            'mensaje'   => 'nullable|string',
        ]);

        Solicitud::create([
            'user_id'   => auth()->id(),
            'propiedad_id' => $id,
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

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        if ($solicitud->estatus === 'Aceptado') {
            return redirect()->back()->with('error', 'No puedes cancelar una solicitud que ya ha sido aceptada.');
        }

        $solicitud->delete();

        return redirect()->route('solicitudes')->with('success', 'Solicitud cancelada y eliminada correctamente.');
    }

}
