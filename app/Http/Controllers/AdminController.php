<?php 

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use App\Models\Review;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

class AdminController extends Controller {

    public function index() {
        
        $totalUsers = User::count();
        $totalPropiedades = Propiedad::count();
        $totalReviews = Review::count();

        return view('admin.index', compact('totalUsers', 'totalPropiedades', 'totalReviews'));
    }
    
    public function usersview() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function propiedadesview() {
        $barrio = Barrio::all();
        $propiedades = Propiedad::all();
        return view('admin.propietario.index', compact('propiedades', 'barrio'));
    }

    public function reviewsview() {
        $reviews = Review::all();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function reviewsearch() {
        $query = Review::query();

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        $reviews = $query->get();

        return view('admin.reviews.index', compact('admin.reviews.index', 'reviews'));
    }

    public function propiedadessearch() {
        $query = Propiedad::query();

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        if (request('tipo')) {
            $query->where('tipo', request('tipo'));
        }

        $propiedades = $query->get();

        return view('admin.propietario.index', compact('propiedades'));
    }

    public function userssearch() {
        $query = User::query();

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        if (request('role')) {
            $query->where('role', request('role'));
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    
}


?>