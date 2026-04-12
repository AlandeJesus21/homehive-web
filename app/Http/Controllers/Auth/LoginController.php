<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function login(Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $key = 'login:' . $request->email . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 3)) {
        $seconds = RateLimiter::availableIn($key);

    return back()
        ->withErrors([
            'email' => "Demasiados intentos."
        ])
        ->with('blocked', true)
        ->with('seconds', $seconds)
        ->onlyInput('email');
        }

    if (!Auth::attempt($credentials)) {
        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'email' => 'Credenciales son incorrectas. Intenta nuevamente.',
        ])->onlyInput('email');
    }

    RateLimiter::clear($key);

    $request->session()->regenerate();

    return redirect()->intended('/home');
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}