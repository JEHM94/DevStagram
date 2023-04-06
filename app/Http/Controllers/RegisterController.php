<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Modifica el Request del username para evitar registros duplicados
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validación
        $this->validate($request, [
            // Nombre Máximo 30 caracteres
            'name' => 'required|max:30',
            // Username único en la tabla de users, mínimo 3 caracteres, máximo 20
            'username' => 'required|unique:users|min:3|max:20',
            // Email único en la tabla de users, máximo 20 caracteres, validación de email
            'email' => 'required|unique:users|max:20|email',
            // Password mínmimo 6 caracteres, máximo 30, valida con el campo de password_confirmation
            'password' => 'required|min:6|max:30|confirmed'
        ]);

        // Guarda el nuevo Usuario
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autenticar usuario
        /* auth()->attempt([
            'email' => $request->email,
            'password' => $request->password

        ]); */
        // Otra forma de Autenticar al usuario
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar
        return redirect()->route('posts.index');
    }
}
