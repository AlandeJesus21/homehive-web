<?php

use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AppReviewController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use GuzzleHttp\Middleware;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Laravel\Socialite\Socialite;
use App\Models\User;




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

Route::get('/acerca', function () {
    return view('main.acerca');
})->name('acerca');

Route::get('/terminos', function () {
    return view('main.terminos');
})->name('terminos');

Route::get('/politica', function () {
    return view('main.politicas');
})->name('politica');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/comentarios', [AppReviewController::class, 'main']
)->name('comentarios');

Route::post('/save_review', [AppReviewController::class, 'store']
)->name('save_review');

Route::post('/logout', function() {
    FacadesAuth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');



Route::get('/home', [HomeController::class, 'index'])->name('home');





    Route::get('/propietario',
     [PropiedadController::class, 'dashboard'])
        ->name('propietario.index');


    Route::get('/propiedades', [PropiedadController::class, 'index'])
        ->name('propiedades.index');


    Route::get('/propiedades/crear',
     [PropiedadController::class, 'create'])
    ->name('propiedades.create');

    Route::post('/propiedades', [PropiedadController::class, 'store'])
        ->name('propiedades.store');

    Route::get('/propiedades/{id}',
     [PropiedadController::class, 'show'])
        ->name('propiedades.show');

    Route::get('/propiedades/{id}/editar', [PropiedadController::class,
    'edit'])
        ->name('propiedades.edit');

    Route::put('/propiedades/{id}',
     [PropiedadController::class, 'update'])
        ->name('propiedades.update');

    Route::delete('/propiedades/{propiedad}',
    [PropiedadController::class, 'destroy'])
        ->name('propiedades.destroy');

    Route::delete('/propiedades/foto/{id}', [PropiedadController::class,
    'destroyFoto'])
        ->name('propiedades.foto.destroy');





Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth')->name('admin.index');

Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');





Route::get('/inquilino', function () {
    return view('inquilino.index');
})->name('inquilino.index');

