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
        if ($user->role === "arendador") {
            return redirect()->route('arendador.index');
        }

        if ($user->role === "inquilino") {
            return redirect()->route('inquilino.index');
        }

        if ($user->role === "admin") {
            return redirect()->route('admin.index');
        }
    }
    
}