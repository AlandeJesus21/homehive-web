<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favoritos;

class FavoritosController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $favoritos = Favoritos::with('propiedad')
            ->where('user_id', $user->id)
            ->get()
            ->pluck('propiedad');

        return response()->json([
            'data' => $favoritos
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'propiedad_id' => 'required|exists:propiedades,id',
            ]);

            $user = $request->user();

            if (!$user) {
                return response()->json(['error' => 'No autenticado'], 401);
            }

            $favorito = Favoritos::create([
                'user_id' => $user->id,
                'propiedad_id' => $request->propiedad_id,
            ]);

            return response()->json([
                'message' => 'ok',
                'data' => $favorito
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($propiedad_id, Request $request)
    {
        $user = $request->user();

        $favorito = Favoritos::where('user_id', $user->id)
            ->where('propiedad_id', $propiedad_id)
            ->first();

        if (!$favorito) {
            return response()->json(['message' => 'Favorito no encontrado'], 404);
        }

        $favorito->delete();

        return response()->json([
            'message' => 'Favorito eliminado correctamente'
        ], 200);
    }
    
}
