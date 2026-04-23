<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Propiedad;
use App\Models\User;
use App\Services\FirebaseService;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SolicitudNotification;

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
        $solicitudes->appends($request->all());

        return view('propietario.solicitudes.index', compact('solicitudes'));
    }

    public function verDetalle($id)
    {
        $solicitud = Solicitud::with(['propiedad', 'aspirante'])->findOrFail($id);
        return view('propietario.solicitudes.show', compact('solicitud'));
    }

    public function aceptar($id, FirebaseService $firebase)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->load('propiedad');

        $propiedadReal = Propiedad::findOrFail($solicitud->propiedad_id);

        $solicitud->update(['estatus' => 'Aceptado']);

        $otrasSolicitudes = Solicitud::where('propiedad_id', $solicitud->propiedad_id)
            ->where('id', '!=', $id)
            ->where('estatus', 'Pendiente')
            ->get();

        foreach ($otrasSolicitudes as $otra) {
            $otra->update(['estatus' => 'Rechazado']);
            
            $usuarioRechazado = User::find($otra->user_id);
            if ($usuarioRechazado) {
                $usuarioRechazado->notify(new SolicitudNotification($otra, 'rechazada'));
                
                if ($usuarioRechazado->fcm_token) {
                    $firebase->sendNotification(
                        $usuarioRechazado->fcm_token,
                        'Actualización de Solicitud',
                        "Lo sentimos, la propiedad '{$solicitud->propiedad}' ya no está disponible."
                    );
                }
            }
        }

        Pago::create([
            'propiedad_id'  => $solicitud->propiedad_id,
            'user_id'       => $solicitud->user_id,
            'arrendador_id' => $propiedadReal->user_id,
            'monto'         => $solicitud->precio,
            'fecha_inicio'  => now(),
            'fecha_fin'     => now()->addMonth(),
            'status'        => 'pendiente',
        ]);

        $user = User::find($solicitud->user_id);
        if ($user) {
            $user->notify(new SolicitudNotification($solicitud, 'aceptada'));
            if ($user->fcm_token) {
                $firebase->sendNotification(
                    $user->fcm_token,
                    '¡Solicitud Aceptada!',
                    "Tu solicitud para '{$solicitud->propiedad}' ha sido aceptada. Se ha generado un registro de pago."
                );
            }
        }

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud aceptada. Las demás solicitudes para esta propiedad han sido rechazadas automáticamente.');
    }

    public function rechazar($id, FirebaseService $firebase)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update(['estatus' => 'Rechazado']);

        $user = User::find($solicitud->user_id);
        if ($user) {
            $user->notify(new SolicitudNotification($solicitud, 'rechazada'));
            if ($user->fcm_token) {
                $firebase->sendNotification(
                    $user->fcm_token,
                    '¡Solicitud Rechazada!',
                    "Tu solicitud para '{$solicitud->propiedad}' ha sido rechazada."
                );
            }
        }

        return redirect()->back()->with('success', 'La solicitud ha sido rechazada.');
    }

    public function historial(Request $request)
    {
        $query = Solicitud::where('user_id', Auth::id())->with('propiedad');

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')->paginate(10);
        $solicitudes->appends($request->all());

        return view('inquilino.solicitudes', compact('solicitudes'));
    }

    public function solicitarpropiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        return view('inquilino.solicitud', compact('propiedad'));
    }

    public function store(Request $request, $id, FirebaseService $firebase)
    {
        $request->validate([
            'titulo'    => 'required|string',
            'precio'    => 'required|numeric',
            'curp'      => 'required|string|max:18',
            'edad'      => 'required|integer',
            'ocupacion' => 'required|string',
            'fecha'     => 'required|date|after_or_equal:today',
            'telefono'  => 'required|string',
            'mensaje'   => 'nullable|string',
        ]);

        $solicitud = Solicitud::create([
            'user_id'      => auth()->id(),
            'propiedad_id' => $id,
            'propiedad'    => $request->titulo,
            'precio'       => $request->precio,
            'estatus'      => 'Pendiente',
            'curp'         => $request->curp,
            'edad'         => $request->edad,
            'ocupacion'    => $request->ocupacion,
            'fecha'        => $request->fecha,
            'telefono'     => $request->telefono,
            'mensaje'      => $request->mensaje,
        ]);

        $propiedad = Propiedad::findOrFail($id);
        $propietario = User::find($propiedad->user_id);

        if ($propietario) {
            $propietario->notify(new SolicitudNotification($solicitud, 'nueva'));
            if ($propietario->fcm_token) {
                $firebase->sendNotification(
                    $propietario->fcm_token,
                    '¡Nueva Solicitud Recibida!',
                    "Has recibido una nueva solicitud para tu propiedad '{$propiedad->titulo}'.", 
                    ['type' => 'solicitud', 'id' => $id]
                );
            }
        }

        return redirect()->route('solicitudes')->with('success', 'Solicitud enviada correctamente');
    }

    public function show($id)
    {
        $solicitud = Solicitud::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        return view('inquilino.versolicitud', compact('solicitud'));
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso.');
        }

        if ($solicitud->estatus === 'Aceptado') {
            return redirect()->back()->with('error', 'No puedes cancelar una solicitud ya aceptada.');
        }

        $solicitud->delete();
        return redirect()->route('solicitudes')->with('success', 'Solicitud cancelada.');
    }
}