<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /// *********** NOT IN USE, DELETE  *************/////
    // Moved to ComentarioPost
    
    /* public function store(Request $request, User $user, Post $post)
    {
        // Validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // Guarda el comentario
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // Redirecciona de vuelta
        return back()->with('mensaje', 'Comentario enviado');
    } */
}
