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

Route::get('/acerca', function () { return view('main.acerca'); })->name('acerca');
Route::get('/terminos', function () { return view('main.terminos'); })->name('terminos');
Route::get('/politica', function () { return view('main.politicas'); })->name('politica');

Route::get('/comentarios', [AppReviewController::class, 'main'])->name('comentarios');
Route::get('/busqueda', [IndexController::class, 'search'])->name('busqueda');

// Verificación de Email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $user = $request->user();

    if ($user->from_app) {
        return view('auth.verified-success');
    }

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



// Reenviar correo
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Correo de verificación reenviado');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Recibos y Contratos
Route::get('/pagos/{id}/recibo', [PagoController::class, 'descargarRecibo'])->name('pagos.recibo')->middleware('auth');
Route::get('/pagos/{id}/contrato', [PagoController::class, 'descargarContrato'])->name('pagos.contrato')->middleware('auth');

// Descarga APK
Route::get('/descargar-app', function () {
    $file = public_path('downloads/HomeHive.apk');
    if (!file_exists($file)) return "El archivo no existe.";
    return response()->download($file, 'HomeHive.apk');
})->name('apk.download');

/*
| AUTENTICACION Y SOCIALITE
*/

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', function() {
    FacadesAuth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/google-auth/redirect', function () { return Socialite::driver('google')->redirect(); });
Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
    $user = User::updateOrCreate(['google_id' => $user_google->id], ['email' => $user_google->email, 'name' => $user_google->name]);
    
    if(!$user->avatar){
        $avatarsave = Http::get($user_google->avatar)->body();
        $avatarname = 'avatars/'. Str::uuid() . '.jpg';
        Storage::disk('public')->put($avatarname, $avatarsave);
        $user->avatar = $avatarname;
        $user->save();
    }
    if (!$user->email_verified_at) { $user->email_verified_at = now(); $user->save(); }
    FacadesAuth::login($user);
    return $user->role == null ? redirect('/select_rol') : redirect('/home');
});

/*
| RUTAS PROTEGIDAS
*/

Route::middleware(['auth', 'verified', 'nocache'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/perfil', [UserController::class, 'edit'])->name('perfil');
    Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');
    Route::get('/select_rol', function () { return view('auth.select_rol'); })->name('select_rol');
    Route::post('/select_role', function () {
        $user = FacadesAuth::user();
        if ($user->role !== null) return redirect('/home');
        $user->role = request('role');
        $user->save();
        return redirect('/home');
    });
    Route::post('/save_review', [AppReviewController::class, 'store'])->name('save_review');
});

/*
| RUTAS ADMIN
*/

Route::middleware(['auth','role:admin', 'verified', 'nocache'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'usersview'])->name('admin.users');
    Route::get('/admin/propiedades', [AdminController::class, 'propiedadesview'])->name('admin.propiedades');
    Route::get('/admin/reviews', [AdminController::class, 'reviewsview']);
    Route::get('/admin/propiedades/search', [AdminController::class, 'propiedadessearch'])->name('propiedades.search');
    Route::get('/admin/reviews/search', [AdminController::class, 'reviewsearch'])->name('reviews.search');
    Route::get('/admin/users/search', [AdminController::class, 'userssearch'])->name('users.search');
    Route::get('/reporte', [PdfController::class, 'ReporUser']);
    Route::get('/reportepropiedades', [PdfController::class, 'ReporProp']);
    Route::get('/admin/backup', [AdminController::class, 'backupDatabase'])->name('admin.backup');
    Route::get('admin/reporeview', [PdfController::class,'reporteReviews'])->name('admin.reviews');
});

/*
| RUTAS PROPIETARIO
*/

Route::middleware(['auth', 'role:propietario', 'verified', 'nocache'])->prefix('propietario')->group(function () {
    Route::get('/', [PropiedadController::class, 'index'])->name('propietario.index');
    
    Route::prefix('propiedades')->group(function () {
        Route::get('/crear', [PropiedadController::class, 'create'])->name('propiedades.create');
        Route::post('/', [PropiedadController::class, 'store'])->name('propiedades.store');
        Route::get('/detalle/{id}', [PropiedadController::class, 'show'])->name('propiedades.show');
        Route::get('/{id}/editar', [PropiedadController::class, 'edit'])->name('propiedades.edit');
        Route::put('/{id}', [PropiedadController::class, 'update'])->name('propiedades.update');
        Route::delete('/{propiedad}', [PropiedadController::class, 'destroy'])->name('propiedades.destroy');

        // Solicitudes para Propietario (Lógica unificada)
        Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
        Route::get('/solicitud/{id}', [SolicitudController::class, 'verDetalle'])->name('propietario.solicitudes.show');
        Route::patch('/solicitud/{id}/aceptar', [SolicitudController::class, 'aceptar'])->name('propietario.solicitud.aceptar');
        Route::patch('/solicitud/{id}/rechazar', [SolicitudController::class, 'rechazar'])->name('propietario.solicitud.rechazar');
    }); 

    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
});

/*
| RUTAS INQUILINO
*/

Route::middleware(['auth','role:inquilino', 'nocache', 'verified'])->group(function () {
    Route::get('/inquilino', [PropiedadController::class,'buscar'])->name('buscar');
    Route::get('/inquilino/vermas{id}', [InquilinoController::class,'vermas'])->name('vermas');
    Route::get('/inqulino/solicitudes', [SolicitudController::class,'historial'])->name('solicitudes');
    
    // Rutas de Solicitud Inquilino
    Route::get('/inquilino/versolicitud/{id}', [SolicitudController::class,'show'])->name('inquilino.versolicitud');
    Route::delete('/inquilino/solicitud/{id}/cancelar', [SolicitudController::class, 'destroy'])->name('cancelarsolicitud');
    Route::get('/inqulino/solicitar/propiedad/{id}', [SolicitudController::class,'solicitarpropiedad'])->name('solicitarpropiedad');
    Route::post('/inquilino/solicitud/{id}', [SolicitudController::class, 'store'])->name('crearsolicitud');

    // Favoritos
    Route::get('/inqulino/favoritos', [FavoriteController::class,'index'])->name('favoritos');
    Route::post('/inqulino/favoritos/{id}', [FavoriteController::class,'toggle'])->name('misfavoritos');
    
    // Pagos (Usando PagoController para el Checkout de Stripe)
    Route::get('/inquilino/mispagos', [PagoController::class, 'misPagos'])->name('pagos');
    Route::get('/mispagos/{id}/checkout', [PagoController::class, 'checkout'])->name('pagos.checkout');

    // Reviews
    Route::post('/inquilino/review/{id}', [ReviewController::class,'store'])->name('review');
    Route::get('/inquilino/editreview/{id}', [ReviewController::class,'edit'])->name('editreview');
    Route::put('/inquilino/editreview/{id}', [ReviewController::class,'update'])->name('updatereview');
    Route::delete('/inquilino/destroyreview/{id}', [ReviewController::class,'destroy'])->name('destroyreview');
    
    Route::get('/filtro', [InquilinoController::class, 'search'])->name('filtro');
});