<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Propiedad;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class InquilinoController extends Controller {


    public function index(){
        $propiedades=Propiedad::all();
        return view('inquilino.index',['propiedades' => $propiedades]);
    }

    public function filtrado(Request $request) {
        $query = Propiedad::query();

        if($request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->start_precio && $request->end_precio) {
            $query->whereBetween('precio', [
                $request->start_precio,
                $request->end_precio
            ]);
        }

        if ($request->barrio) {
            $query->where('barrio', $request->barrio);
        }


        $propiedades = $query->paginate(10);

        return view('inquilino.index', compact('propiedades'));
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
    public function pagos(){
        return view('inquilino.mispagos');
    }
    public function favoritos(){
        return view('inquilino.favoritos');
    }
}

?>
