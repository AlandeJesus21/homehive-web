<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function saveFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string'
        ]);

        $user = $request->user();

        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'message' => 'Token guardado correctamente'
        ]);
    }
}