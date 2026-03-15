<?php

namespace App\Http\Controllers;

use App\Models\AppReview;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AppReviewController extends Controller
{
    // Mostrar todas las reseñas


    public function main()
    {
        $reviews = AppReview::with('usuario')->get();
        return view('main.comen', compact('reviews'));
    }


    // Guardar nueva reseña
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        AppReview::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comentario' => $request->comentario,
        ]);

        

        return redirect()->back()->with('success', 'Gracias por tu reseña.');
    }
}