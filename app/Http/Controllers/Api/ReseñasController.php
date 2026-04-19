<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ReseñasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['view']);
    }
    public function view($propiedad_id = null)
    {
        if ($propiedad_id) {
            $reseñas = Review::with('usuario')
                ->where('propiedad_id', $propiedad_id)
                ->get();
        } else {
            $reseñas = Review::with('user')->get();
        }

        if ($reseñas->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron reseñas',
                'data' => []
            ], 200);
        }

        return response()->json([
            'data' => $reseñas,
            'status' => 200
        ], 200);
    }

    public function pubrese(Request $request){
        $validator = Validator::make($request->all(), [
            'propiedad_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
            'comentario' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Error al guardar la reseña',
                'errors' => $validator->errors()
            ], 400);
        }

        $reseña = Review::create([
            'propiedad_id' => $request->propiedad_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comentario' => $request->comentario,
        ]);

        return response()->json([
            'message' => 'Reseña guardada',
            'data' => $reseña
        ], 201);
    }

    public function update(Request $request, $id){
        $reseña = Review::find($id);

        if(!$reseña) {
            return response()->json([
                'message' => 'No se encontró la reseña'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'comentario' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Error al actualizar',
                'errors' => $validator->errors()
            ], 400);
        }

        $reseña->update([
            'rating' => $request->rating,
            'comentario' => $request->comentario,
        ]);

        return response()->json([
            'message' => 'Reseña actualizada',
            'data' => $reseña
        ], 200);
    }

    public function destroy($id){
        $reseña = Review::find($id);

        if(!$reseña){
            return response()->json([
                'message' => 'No se encontró la reseña'
            ], 404);
        }

        $reseña->delete();

        return response()->json([
            'message' => 'Reseña eliminada'
        ], 200);
    }
}