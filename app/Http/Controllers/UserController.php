<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Review;
use App\Models\Propiedad;

class UserController extends Controller
{
    /** Mostrar formulario de edición */
    public function edit()
    {
        return view('perfil');
    }

    /** Guardar cambios del perfil */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Actualizar datos básicos
        $user->name = $request->name;
        $user->email = $request->email;

        // checar que la imagen no se suba en una carpeta dentro del storage/avatars, sino que se suba directamente a storage/avatars
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $filename = Str::uuid() . '.jpg';

            $avatarname = $file->storeAs('avatars', $filename, 'public');

            $user->avatar = 'avatars/' . $filename;
        }

        // Cambiar password solo si se escribió algo
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
    
        return redirect()->route('home')->with('success', 'Perfil actualizado correctamente.');

    }

}