<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['usuario:id,name', 'propiedad:id,titulo'])->get();
        return response()->json($reviews, 200);
    }

    public function store(Request $request, $idPropiedad)
    {

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500'
        ]);


        $existe = Review::where('propiedad_id', $idPropiedad)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existe) {
            return response()->json(['error' => 'Ya has dejado una reseña.'], 403);
        }

        $review = Review::create([
            'propiedad_id' => $idPropiedad,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comentario' => $request->comentario
        ]);

        return response()->json($review, 201);
    }


    public function show($id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['error' => 'No encontrada'], 404);
        return response()->json($review, 200);
    }


    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500'
        ]);

        $review->update($request->only(['rating', 'comentario']));

        return response()->json([
            'mensaje' => 'Reseña actualizada correctamente',
            'data' => $review
        ], 200);
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $review->delete();

        return response()->json(['mensaje' => 'Reseña eliminada correctamente'], 200);
    }
}
