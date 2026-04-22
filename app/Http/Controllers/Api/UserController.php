<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use League\Config\Exception\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function Users(){
        $user = User::all();

        if($user->isEmpty()){
            $data = [
                'mesagge' => 'No hay usuarios registrados',
                'status' => 200,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'users' => $user,
            'status' => 200,
        ];

        return response()->json($data,202);
        
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Las credenciales son incorrectas'
            ], 401);
        }

        $user = Auth::user();

        $user->tokens()->where('name', $validated['device_name'])->delete();

        $token = $user->createToken($validated['device_name'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login exitoso',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    

    public function show($id) {
        $user = User::find($id);

        if(!$user) {
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 200,
            ];
            return response()->json($data,200);
        }

        $data =[
            'user' => $user,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    public function destroy($id) {
        $user = User::find($id);
        if(!$user) {
            $data = [
              'message' => 'Usuario no encontrado para eliminar',
              'status' => 200,  
            ];
            return response()->json($data, 404);
        }

        $user->delete();
        $data = [
            'message' => 'usuario eliminado correctamente',
            'status' => 200,
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);

        if(!$user){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404,
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

    }

    public function logout(Request $request)
{
    if (!$request->user()) {
        return response()->json([
            'success' => false,
            'message' => 'Usuario no autenticado'
        ], 401);
    }

    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'success' => true,
        'message' => 'Sesión cerrada'
    ]);
}
}