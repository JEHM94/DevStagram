@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 bg-white m-5 pb-5">
            <img class="" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->titulo }}">

            <div class="flex justify-between items-center mt-2">
                @livewire('like-post', ['post' => $post])

                @livewire('total-comentarios', ['post' => $post])
            </div>

            <div class="p-3 pt-0">
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>

                <p class="text-sm text-gray-600">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" class="p-3">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold cursor-pointer">
                    </form>
                @endif
            @endauth

        </div>

        <div class="md:w-1/2 m-5">
            <div class="shadow bg-white p-5 mb-5">
                <p class="text-xl font-bold text-center mb-4">Comentarios</p>

                @guest
                    <div class="text-center p-3 flex flex-col">
                        <p class="mb-5 text-gray-600">
                            Debes inciar sesión para poder comentar esta publicación
                        </p>
                        <a href="{{ route('login') }}"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">Iniciar
                            Sesión</a>
                    </div>
                @endguest

                @livewire('comentario-post', ['post' => $post])

            </div>
        </div>
    </div>
@endsection
