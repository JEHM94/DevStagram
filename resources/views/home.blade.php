@extends('layouts.app')

{{-- @section('titulo')
    Publicaciones Recientes
@endsection --}}

@section('contenido')
    <nav class="flex justify-center items-center gap-10 font-bold text-xl p-5 mb-5 xl:mx-96">
        <a href="{{ route('home') }}"
            class="p-2 rounded-md flex-1 text-center  {{ !$explore ? 'bg-sky-600 text-white' : 'hover:bg-sky-600 hover:text-white' }}">
            Publicaciones Recientes
        </a>

        <a href="{{ route('home.explore') }}"
            class="p-2 rounded-md flex-1 text-center {{ $explore ? 'bg-sky-600 text-white' : 'hover:bg-sky-600 hover:text-white' }}">
            Otros Usuarios
        </a>
    </nav>

    <x-listar-post :posts="$posts" />
@endsection
