@extends('layouts.app')

@section('titulo')
    Perfil de Usuario
@endsection

@push('styles')
    {{-- Modal  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
@endpush

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col justify-center items-center md:flex-row">

            <div class="w-6/12 lg:w-4/12 px-5">
                <img class="rounded-full"
                    src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}"
                    alt="Imagen del Usuario">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl capitalize">{{ $user->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index', $user) }}" class="text-gray-500 hover:text-black cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>

                @livewire('follow-user', ['user' => $user])

            </div>
        </div>
    </div>


    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        <x-listar-post :posts="$posts" />

    </section>
@endsection

@push('scripts')
    {{-- Modal  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
@endpush
