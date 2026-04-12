<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FavoriteController extends Controller
{

    public function toggle($propiedadId)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if (!$user) {
            return back()->with('error', 'Debes iniciar sesión para guardar favoritos.');
        }
        $user->favoritos()->toggle($propiedadId);

        return back()->with('success', 'Lista de favoritos actualizada');

    }


    public function index()
    {
        $propiedades = Auth::user()->favoritos;
        return view('inquilino.favoritos', compact('propiedades'));
    }
}
