@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 bg-white m-5">
            <img class="" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->titulo }}">

            <div class="p-3">
                <p>0 likes</p>
            </div>

            <div class="p-3">
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>

                <p class="text-sm text-gray-600">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="my-5">
                    {{ $post->descripcion }}
                </p>

            </div>
        </div>

        <div class="md:w-1/2 m-5">
            <div class="shadow bg-white p-5 mb-5">
                <p class="text-xl font-bold text-center mb-4">Comentarios</p>
                @auth
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('comentarios.store', [$user, $post]) }}">
                        @csrf
                        <div class="mb-5">

                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Agrega un nuevo comentario
                            </label>

                            <textarea id="comentario" name="comentario" placeholder="Comentar..."
                                class="border p-3 w-full rounded-lg 
                            @error('comentario')
                            border-red-500 
                            @enderror"></textarea>

                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth

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

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-auto mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>

                                <p>
                                    {{ $comentario->comentario }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center text-gray-600">
                            No hay comentarios aún
                        </p>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection
