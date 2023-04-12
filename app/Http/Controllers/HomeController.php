<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Invoke se llama automáticamente y se utiliza si el controlador solo va a tener un solo método
    public function __invoke()
    {
        // Obtiene los ids de los usuarios que sigue
        $followingIds = auth()->user()->followings->pluck('id')->toArray();
        // Busca los Posts de los usuarios que sigue
        $posts = Post::whereIn('user_id', $followingIds)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
