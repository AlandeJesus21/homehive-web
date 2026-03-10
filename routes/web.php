<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Laravel\Socialite\Socialite;
use App\Models\User;


//rutas que se pueden acceder sin autenticacion

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
 
    $user = User::updateOrCreate( [
        'google_id' => $user_google->id,
    ],
        [
            'email' => $user_google->email,
            'name' => $user_google->name,
            'avatar' => $user_google->avatar,
        ]
    );

    FacadesAuth::login($user);

    if($user->role == null){
        return redirect('/select_rol');
    }

    return redirect('/home');
});

Route::post('/select_role', function () {

    $user = FacadesAuth::user();

    if ($user->role !== null) {
        return redirect('/home');
    }

    $user->role = request('role');
    $user->save();

    return redirect('/home');

});

Route::get('/', function () {
    return view('index');
});

Route::get('/select_rol', function () {
    return view('auth.select_rol');
})->name('select_rol');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', function() {
    FacadesAuth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// rutas segun rol

Route::get('/home', [HomeController::class, 'index'])->name('home');

//rutas para el admin
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');

//ruta para inquilinos
Route::get('/inquilino', function () {
    return view('inquilino.index');
})->name('inquilino.index');