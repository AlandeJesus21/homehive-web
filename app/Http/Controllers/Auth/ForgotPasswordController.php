<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Mostrar formulario
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Enviar correo de recuperación
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Se envió el enlace de recuperación')
            : back()->withErrors(['email' => 'No se pudo enviar el enlace']);
    }
}