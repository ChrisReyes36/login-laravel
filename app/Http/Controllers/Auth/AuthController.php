<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  //
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function login(Request $request, Redirector $redirector)
  {
    //validacion de datos
    // $credentials = $request->validated();
    // dump($credentials); //imprimir los datos
    if (Auth::attempt($request->only('email', 'password'))) {
      $request->session()->regenerate(); //reiniciar la sesion, generar nuevo token
      return $redirector->intended('/dashboard')->with('status', 'You are logged in'); //redireccionar a la ruta
    }

    // return redirect('/login'); //redireccionar a la ruta
    throw ValidationException::withMessages([
      // 'email' => __('auth.failed')
      'email' => "El usuario o la contraseña son incorrectos",
    ]);
  }

  public function logout(Request $request, Redirector $redirector)
  {
    Auth::logout();
    $request->session()->invalidate(); //invalidar la sesion
    $request->session()->regenerateToken(); //reiniciar el token
    return $redirector->intended('/')->with('status', 'You are logged out');
  }
}
