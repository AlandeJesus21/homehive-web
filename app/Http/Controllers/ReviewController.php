<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;



class ReviewController extends Controller
{

 //Mostrar reseñas
public function index(){
    $review=Review::all();
    return view('inquilino.vermas', compact('review'));
}
    // Guardar reseña
    public function store(Request $request, $idPropiedad)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500'
        ]);

        // Evitar reseña duplicada
        $existe = Review::where('propiedad_id', $idPropiedad)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya has dejado una reseña para esta propiedad.');
        }

        Review::create([
            'propiedad_id' => $idPropiedad,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comentario' => $request->comentario
        ]);

        return redirect()
        ->route('vermas', $idPropiedad)
        ->with('success', 'Reseña enviada correctamente');
    }

    // Formulario de edición
        public function edit($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        return view('inquilino.editreview', compact('review'));
    }


    // Actualizar reseña
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:500'
        ]);

        $review->update([
            'rating' => $request->rating,
            'comentario' => $request->comentario
        ]);

        return redirect()
            ->route('vermas', $review->propiedad_id)
            ->with('success', 'Reseña actualizada correctamente');
    }

    // Eliminar reseña
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return redirect()
        ->route('vermas', $review->propiedad_id)
        ->with('success', 'Reseña eliminada correctamente');
    }
}
