<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        // Verifica si el usuario está autorizado a para ver formulario de editar el perfil que visita
        $this->authorizeForUser(auth()->user(), 'edit', $user);

        return view('perfil.index', [
            'user' => $user
        ]);
    }

    public function store(Request $request, User $user)
    {
        // Verifica si el usuario está autorizado a para  editar el perfil que visita
        $this->authorizeForUser($user, 'edit', $request->user());

        // Modifica el Request del username para evitar registros duplicados
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            // Username único en la tabla de users, mínimo 3 caracteres, máximo 20
            // 'unique:users,username,' . auth()->user()->id Ignora si el usuario dejó el mismo username
            // ** Por Convención de Laravel si son más de tres reglas, se colocan en un Array **
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20']
        ]);

        // Verifica si hay una imagen y la guarda
        if ($request->imagen) {
            // Guarda el Archivod de la imagen
            $imagen = $request->file('imagen');

            // Genera el nombre único
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            // Crea la imagen con intervention image
            $imagenServidor = Image::make($imagen);

            // Recorta la imagen
            $imagenServidor->fit(1000, 1000);

            // Path de la imagen
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            // Guarda la imagen en el servidor
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
