<?php

use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AppReviewController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Validation\Rules\In;

/*
| RUTAS PUBLICAS
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/inicio', [IndexController::class, 'index'])->name('inicio');

Route::get('/acerca', function () {
    return view('main.acerca');
})->name('acerca');

Route::get('/terminos', function () {
    return view('main.terminos');
})->name('terminos');

Route::get('/politica', function () {
    return view('main.politicas');
})->name('politica');

Route::get('/comentarios', [AppReviewController::class, 'main'])
->name('comentarios');

Route::get('/propiedades/{id}', [IndexController::class, 'show'])->name('propiedades.show');
Route::get('/busqueda', [IndexController::class, 'search'])->name('busqueda');


/*
| AUTENTICACION
*/

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


/*
| GOOGLE LOGIN
*/


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


/*
| RUTAS PROTEGIDAS (LOGIN)
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/perfil', [UserController::class, 'edit'])->name('perfil');

    Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');

    Route::get('/select_rol', function () {
        return view('auth.select_rol');
    })->name('select_rol');

    Route::post('/select_role', function () {

        $user = FacadesAuth::user();

        if ($user->role !== null) {
            return redirect('/home');
        }

        $user->role = request('role');
        $user->save();

        return redirect('/home');

    });

    Route::post('/save_review', [AppReviewController::class, 'store'])
    ->name('save_review');

});


/*
| RUTAS ADMIN
*/

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/users', [AdminController::class, 'usersview'])
    ->name('admin.users');

    Route::get('/admin/propiedades', [AdminController::class, 'propiedadesview'])
    ->name('admin.propiedades');

    Route::get('/admin/reviews', [AdminController::class, 'reviewsview']);

    Route::get('/admin/propiedades/search', [AdminController::class, 'propiedadessearch'])->name('propiedades.search');

    Route::get('/admin/reviews/search', [AdminController::class, 'reviewsearch'])->name('reviews.search');

    Route::get('/admin/users/search', [AdminController::class, 'userssearch'])->name('users.search');

    Route::get('/reporte', [PdfController::class, 'ReportUser']);

    Route::get('/reportepropiedades', [PdfController::class, 'ReportPropiedad']);



});


/*
| RUTAS PROPIETARIO
*/


Route::middleware(['auth','role:propietario'])->group(function () {

    Route::get('/propietario', function () {
        return view('propietario.index');
    })->name('propietario.index');

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



});








/*
| RUTAS INQUILINO
*/

Route::middleware(['auth','role:inquilino'])->group(function () {
//ruta para inquilinos

Route::get('/inquilino', [InquilinoController::class,'index'])->name('inquilino.index');

Route::get('/inquilino/vermas{id}', [InquilinoController::class,'vermas'])->name('vermas');

Route::get('/inqulino/solicitudes', [InquilinoController::class,'solicitudes'])->name('solicitudes');
Route::get('/inqulino/solicitud', [InquilinoController::class,'solicitar'])->name('solicitud');

Route::get('/inqulino/versolicitud', [InquilinoController::class,'versolicitud'])->name('versolicitud');

Route::get('/inqulino/pagos', [InquilinoController::class,'pagos'])->name('pagos');

// Route::post('/comentarios', [ReviewController::class, 'store'])->name('comentarios')->middleware('auth');

    Route::get('/filtro', [InquilinoController::class, 'filtrado']);

});