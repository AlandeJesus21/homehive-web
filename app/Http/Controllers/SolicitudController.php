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
                // Filtramos solicitudes cuyas casas pertenecen al dueño logueado
                $q->where('user_id', Auth::id()); 
            });

        // Filtros de fecha
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
        // Buscamos la solicitud asegurándonos que traiga la propiedad y el aspirante
        $solicitud = Solicitud::with(['propiedad', 'aspirante'])->findOrFail($id);

        // Retornamos la vista que está en resources/views/propietario/solicitudes/show.blade.php
        return view('propietario.solicitudes.show', compact('solicitud'));
    }

    public function aceptar($id)
    {
        // 1. Buscamos la solicitud
        $solicitud = Solicitud::findOrFail($id);

        // 2. Buscamos la propiedad real usando el ID que guardamos en la tabla
        $propiedadReal = Propiedad::findOrFail($solicitud->propiedad_id);

        // 3. Actualizamos la solicitud
        $solicitud->update(['estatus' => 'Aceptado']);

        // 4. Creamos el pago (usamos $propiedadReal->user_id para obtener el ID del dueño)
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
        return redirect()->route('solicitudes')->with('success', '¡Tu solicitud ha sido enviada con éxito!');
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Seguridad: Solo el dueño de la solicitud puede cancelarla
        if ($solicitud->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $solicitud->delete();

        return redirect()->route('solicitudes')->with('success', 'Solicitud cancelada y eliminada correctamente.');
    }

}
