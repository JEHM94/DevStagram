<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        // Validación
        $this->validate($request, [
            // Email obligatorio y validación de email
            'email' => 'required|email',
            // Password obligatorio
            'password' => 'required'
        ]);

        // Comprueba hay errores en la autenticación
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // Redirecciona si el inicio de sesión es correcto
        return redirect()->route('posts.index',  auth()->user()->username);
    }
}
