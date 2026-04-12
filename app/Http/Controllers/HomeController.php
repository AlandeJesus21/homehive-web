<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        if ($user->role === "propietario") {
            return redirect()->route('propietario.index');
        }

        if ($user->role === "inquilino") {
            return redirect()->route('buscar');
        }

        if ($user->role === "admin") {
            return redirect()->route('admin.index');
        }

    }

}