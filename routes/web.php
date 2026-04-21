<?php

use App\Http\Controllers\PropiedadController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AppReviewController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SolicitudController;

/*
| RUTAS PUBLICAS
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/inicio', [IndexController::class, 'index'])->name('inicio');

Route::get('/vermas/{id}', [IndexController::class, 'vermas'])->name('main.vermas');

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

Route::get('/busqueda', [IndexController::class, 'search'])->name('busqueda');

// Mostrar aviso de verificación
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


// Verificar correo (link del email)
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


// Reenviar correo
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Correo de verificación reenviado');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Recibos de pagos
Route::get('/pagos/{id}/recibo', [PagoController::class, 'descargarRecibo'])->name('pagos.recibo')->middleware('auth');
Route::get('/pagos/{id}/contrato', [PagoController::class, 'descargarContrato'])->name('pagos.contrato')->middleware('auth');

/*
| AUTENTICACION
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);


// Mostrar formulario (correo)
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Enviar correo
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Mostrar formulario con token
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Guardar nueva contraseña
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

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
        ]
    );

    if(!$user->avatar){
        
            $avatarsave = Http::get($user_google->avatar)->body();

             $avatarname = 'avatars/'. Str::uuid() . '.jpg';

            Storage::disk('public')->put($avatarname, $avatarsave);
            $user->avatar = $avatarname;
            $user->save();
    }

    if (!$user->email_verified_at) {
        $user->email_verified_at = now();
        $user->save();
    }

    FacadesAuth::login($user);

    if($user->role == null){
        return redirect('/select_rol');
    }

    return redirect('/home');
});


/*
| RUTAS PROTEGIDAS (LOGIN)
*/

Route::middleware('auth', 'verified', 'nocache')->group(function () {

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

Route::middleware(['auth','role:admin', 'verified', 'nocache'])->group(function () {
    

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/users', [AdminController::class, 'usersview'])
    ->name('admin.users');

    Route::get('/admin/propiedades', [AdminController::class, 'propiedadesview'])
    ->name('admin.propiedades');

    Route::get('/admin/reviews', [AdminController::class, 'reviewsview']);

    Route::get('/admin/propiedades/search', [AdminController::class, 'propiedadessearch'])->name('propiedades.search');

    Route::get('/admin/reviews/search', [AdminController::class, 'reviewsearch'])->name('reviews.search');

    Route::get('/admin/users/search', [AdminController::class, 'userssearch'])->name('users.search');

    Route::get('/reporte', [PdfController::class, 'ReporUser']);

    Route::get('/reportepropiedades', [PdfController::class, 'ReporProp']);

    Route::get('/admin/backup', [AdminController::class, 'backupDatabase'])->name('admin.backup');


});


/*
| RUTAS PROPIETARIO
*/
Route::middleware(['auth', 'role:propietario', 'verified', 'nocache'])->prefix('propietario')->group(function () {

    // Dashboard principal: /propietario
    Route::get('/', [PropiedadController::class, 'index'])
        ->name('propietario.index');

    // Gestión de Propiedades: /propietario/propiedades
    Route::prefix('propiedades')->group(function () {
        
        // Crear: /propietario/propiedades/crear
        Route::get('/crear', [PropiedadController::class, 'create'])
            ->name('propiedades.create');

        // Guardar: /propietario/propiedades
        Route::post('/', [PropiedadController::class, 'store'])
            ->name('propiedades.store');

        // Ver Detalle: /propietario/propiedades/detalle/{id}
        Route::get('/detalle/{id}', [PropiedadController::class, 'show'])
            ->name('propiedades.show');

        // Editar: /propietario/propiedades/{id}/editar
        Route::get('/{id}/editar', [PropiedadController::class, 'edit'])
            ->name('propiedades.edit');

        // Actualizar: /propietario/propiedades/{id}
        Route::put('/{id}', [PropiedadController::class, 'update'])
            ->name('propiedades.update');

        // Eliminar: /propietario/propiedades/{propiedad}
        Route::delete('/{propiedad}', [PropiedadController::class, 'destroy'])
            ->name('propiedades.destroy');

        Route::get('/solicitudes', [SolicitudController::class, 'index'])
            ->name('solicitudes.index');
        Route::get('/solicitudes/{id}', [SolicitudController::class, 'verDetalle'])
            ->name('propietario.solicitudes.show');
        Route::patch('/solicitudes/{id}/aceptar', [SolicitudController::class, 'aceptar'])
            ->name('propietario.solicitud.aceptar');
        Route::patch('/solicitudes/{id}/rechazar', [SolicitudController::class, 'rechazar'])
            ->name('propietario.solicitud.rechazar');
    }); 

    
    Route::get('/pagos', [PagoController::class, 'index'])
        ->name('pagos.index');

    Route::get('/solicitudes', [SolicitudController::class, 'index'])
        ->name('solicitudes.index'); 

});



/*
| RUTAS INQUILINO
*/

Route::middleware(['auth','role:inquilino', 'nocache', 'verified'])->group(function () {
//ruta para inquilinos

    //Route::get('/inquilino', [InquilinoController::class,'index'])->name('inquilino.index');
    Route::get('/inquilino', [PropiedadController::class,'buscar'])->name('buscar');
    Route::get('/inquilino/vermas{id}', [InquilinoController::class,'vermas'])->name('vermas');//vista para ver mas detalles de la propiedad
    Route::get('/inqulino/solicitudes', [SolicitudController::class,'historial'])->name('solicitudes');//vista para ver el historial, de solicitudes
    Route::get('/inquilino/versolicitud/{id}', [SolicitudController::class,'show'])->name('inquilino.versolicitud');
    Route::delete('/inquilino/solicitud/{id}/cancelar', [SolicitudController::class, 'destroy'])->name('cancelarsolicitud');
    Route::get('/inqulino/favoritos', [FavoriteController::class,'index'])->name('favoritos');
    Route::post('/inqulino/favoritos/{id}', [FavoriteController::class,'toggle'])->name('misfavoritos');
    Route::get('/inqulino/solicitar/propiedad/{id}', [SolicitudController::class,'solicitarpropiedad'])->name('solicitarpropiedad');//Vista para mandar solicitud para rentar
    Route::get('/inquilino/mispagos', [InquilinoController::class,'pagos'])->name('pagos');
    // Route::post('/comentarios', [ReviewController::class, 'store'])->name('comentarios')->middleware('auth');
    Route::post('/inquilino/solicitud/{id}', [SolicitudController::class, 'store'])->name('crearsolicitud');//ruta para crear la solicitud
    Route::post('/inquilino/review/{id}', [ReviewController::class,'store'])->name('review');
    Route::get('/inquilino/editreview/{id}', [ReviewController::class,'edit'])->name('editreview');
    Route::put('/inquilino/editreview/{id}', [ReviewController::class,'update'])->name('updatereview');
    Route::delete('/inquilino/destroyreview/{id}', [ReviewController::class,'destroy'])->name('destroyreview');
    //Route::post('/inquilino/editreview/{id}', [ReviewController::class,'edit'])->name('editreview');
    Route::get('/filtro', [InquilinoController::class, 'search'])->name('filtro');
    Route::get('/mispagos/{id}/checkout', [App\Http\Controllers\PagoController::class, 'checkout'])->name('pagos.checkout');

});
