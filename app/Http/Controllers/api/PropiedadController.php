<?php

namespace App\Http\Controllers\Api;

use App\Models\Propiedad;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


class PropiedadController extends Controller
{
    public function Propiedades() {
        $propiedades = Propiedad::all();

        if($propiedades->isEmpty()) {
            $data = [
                'message' => 'No se encontraron propiedades',
                'status' => 200,
            ];
            return response()->json($data, 202);
        }

        $data = [
            'propiedades' => $propiedades,
            'status' => 200,
        ];
    }
}