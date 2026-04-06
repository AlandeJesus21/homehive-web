<?php

namespace App\Http\Controllers\Api;

use App\Models\Propiedad;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropiedadController extends Controller
{
    public function propiedades() {
        $propiedades = Propiedad::all();

        if($propiedades->isEmpty()) {
            $data = [
                'message' => 'No se encontraron propiedades',
                'status' => 200,
            ];
            return response()->json(['success' => false, 'data' => ['message' => 'No se encontraron propiedades']], 404);
        }

        $data = [
            'propiedades' => $propiedades,
            'status' => 200,
        ];

        return response()->json($data,200);
    }

    public function vermas($id){
        $prop = Propiedad::find($id);

        if(!$prop) {
            return response()->json(['message' => 'No se encontro la propiedad', 'status'=>404],404);
        }

        return response()->json(['data' => $prop,'status' => 200], 200);
    }

    public function update(Request $request, $id) {
        $prop = Propiedad::find($id);

        if(!$prop) {
            return response()->json(['success' => false, 'data' => ['message' => 'No se encontro la propiedad']]);
        }

        $validator = Validator::make( $request->all(), [
            'titulo' => 'required',
            'precio' => 'required',
            'forma_pago' => 'required',
            'servicio' => 'required',
            'descripcion' => 'required',
            'reglas' => 'required',
            'cercanias' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Error al guardar cambios',
             'errors' => $validator->errors(), 
             'status'=> 400], 400);
        }

        $prop->titulo = $request->titulo;
        $prop->precio = $request->precio;
        $prop->forma_pago = $request->forma_pago;
        $prop->servicio = $request->servicio;
        $prop->descripcion = $request->descripcion;
        $prop->reglas = $request->reglas;
        $prop->cercanias = $request->cercanias;

        $prop->save();

        return response()->json(['message' => 'Propiedad actualizada correctamente',
         'data' => $prop, 'status' => 200 ],
          200);

    }

    public function destroy($id) {
        $prop = Propiedad::find($id);

        if(!$prop) {
            return response()->json(['message' => 'error al eliminar la propiedad','status'=> 400], 400);
        }

        $prop->delete();

        return response()->json(['message' => 'propiedad eliminada correctamente', 'status' => 200],200);
    }
}