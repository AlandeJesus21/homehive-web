<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;

class InquilinoController extends Controller {


    public function index(){
        return view('index');
    }

    public function vermas(){
        return view('vermas');
    }

    public function solicitud(){
        return view('solicitud');
    }

}

?>
