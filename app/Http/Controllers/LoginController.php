<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('welcome');
        }

        return redirect()->back()->withErrors('Verifica tus credenciales.');
    }

    
    public function authenticated(Request $request)
    {
        if (Auth::check()) {
            return redirect('welcome');
        }
        return redirect()->back()->withErrors('Acceso no autorizado.');
    }
    
    public function logout()
{
    // Eliminar todos los datos de sesión del usuario
    Session::flush();

    // Redireccionar al usuario a la página de inicio o a donde desees después de cerrar sesión
    return redirect('/');
}
    
}
