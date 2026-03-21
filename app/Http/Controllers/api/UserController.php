<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

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
}