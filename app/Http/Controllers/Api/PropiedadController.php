<?php

namespace App\Http\Controllers\Api;

use App\Models\Propiedad;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropiedadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['propiedades', 'vermas']);
    }   
    
    public function propiedades() {
        $propiedades = Propiedad::with('barrio', 'imagenes')->get();

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

    public function getByUser()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'No autenticado'
            ], 401);
        }

        $propiedades = Propiedad::with('barrio', 'imagenes')->where('user_id', $user->id)->get();

        return response()->json([
            'data' => $propiedades
        ], 200);
    }

    public function vermas($id){
        $prop = Propiedad::with('barrio', 'propiedad_imagenes')->find($id);

        if(!$prop) {
            return response()->json(['message' => 'No se encontro la propiedad', 'status'=>404],404);
        }

        return response()->json(['data' => $prop,'status' => 200], 200);
    }

    public function update(Request $request, $id)
    {
        $prop = Propiedad::find($id);

        if (!$prop) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró la propiedad'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'precio' => 'required|numeric',
            'forma_pago' => 'required|string',
            'servicio' => 'required',
            'descripcion' => 'required|string',
            'reglas' => 'required|string',
            'cercanias' => 'required|string', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al guardar cambios',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $prop->update([
            'titulo' => $request->titulo,
            'precio' => $request->precio,
            'forma_pago' => $request->forma_pago,
            'servicio' => $request->servicio, // JSON string
            'descripcion' => $request->descripcion,
            'reglas' => $request->reglas,
            'cercanias' => $request->cercanias,
        ]);

        return response()->json([
            'message' => 'Propiedad actualizada correctamente',
            'data' => $prop,
            'status' => 200
        ], 200);
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