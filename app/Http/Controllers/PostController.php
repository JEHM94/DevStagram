<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Proteger las rutas del controlador de usuarios no autenticados
    public function __construct()
    {
        $this->middleware('auth')->except('show','index');
    }

    public function index(User $user)
    {
        // Busca los Posts del Usuario
        //$posts = Post::where('user_id', $user->id)->get();

        // Para paginación
        $posts = Post::where('user_id', $user->id)->paginate(20);
        // Otra paginación más simple
        //$posts = Post::where('user_id', $user->id)->simplePaginate(5);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Valida los campos del formulario
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Crea el Nuevo registro
        /* Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        // Otra forma de crear el registro
        /* $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save(); */

        // Otra forma de crear el Registro (con las relaciones ya creadas)
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);


        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
}
