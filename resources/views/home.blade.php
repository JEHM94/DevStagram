@extends('layouts.app')

@section('titulo')
    Publicaciones Recientes
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />    
@endsection
