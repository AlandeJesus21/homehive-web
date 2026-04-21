<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\User;
use App\Models\Review;
use App\Models\Propiedad;
use App\Models\Pago;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class InquilinoController extends Controller {


    public function index(){
        return "ESTOY EDITANDO EL ARCHIVO CORRECTO";
        $propiedades=Propiedad::all();
        $barrios = Barrio::all();
        return view('inquilino.index',['propiedades' => $propiedades, 'barrios' => $barrios]);
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

        if ($request->filled('servicio')) {
            foreach ($request->servicio as $s) {
                $query->whereJsonContains('servicio', $s);
            }
        }

        $cuartos = (clone $query)->where('tipo', 'cuarto')->get();
        $departamentos = (clone $query)->where('tipo', 'departamento')->get();
        $casas = (clone $query)->where('tipo', 'casa')->get();

        $barrios = Barrio::all();
        


        return view('inquilino.index', compact('cuartos', 'departamentos', 'casas', 'barrios'));
    }

    public function vermas($id){
        $propiedad=Propiedad::findOrFail($id);
        $review = Review::where('propiedad_id', $id)->with('usuario')->get();
        return view('inquilino.vermas', compact('propiedad', 'review'));
    }
    public function solicitar(){
        return view('inquilino.solicitud');
    }
    public function solicitudes(){
        return view('inquilino.solicitudes');
    }

    public function versolicitud(){
        return view('inquilino.versolicitud');
    }

    public function pagos(Request $request) {
        $query = Pago::with('propiedad')->where('user_id', auth()->id());

        // Filtro por fecha 'desde'
        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        // Filtro por fecha 'hasta'
        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        $pagos = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('inquilino.mispagos', compact('pagos'));
    }
    public function favoritos(){
        return view('inquilino.favoritos');
    }
}

?>
