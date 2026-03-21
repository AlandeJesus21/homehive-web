<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

class AdminController extends Controller {
    
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    
}


?>