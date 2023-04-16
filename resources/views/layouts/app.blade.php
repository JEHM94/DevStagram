<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Para cargar hojas de estilo adicionales --}}
    @stack('styles')

    <title>DevStagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @livewireStyles

</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center flex-col gap-3 md:flex-row">
            <a href="{{ route('home') }}" class="text-3xl font-black">
                DevStagram
            </a>


            {{-- Verificación si el usuario está autenticado --}}
            @auth
                <nav class="flex gap-2 items-center w-full justify-between md:w-auto">

                    <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                        Hola:
                        <span class="font-normal whitespace-nowrap capitalize">
                            {{ auth()->user()->username }}
                        </span>
                    </a>

                    <a href="{{ route('posts.create') }}"
                        class="order-first md:order-none h-9 flex items-center gap-1 text-sm bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-2 text-white rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                        Crear
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="h-auto md:h-9 text-sm p-2 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold text-white rounded-lg">
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            @endauth

            {{-- Verificación si el usuario NO está autenticado --}}
            @guest
                <nav class="flex gap-2 items-center justify-between w-full md:w-auto">
                    <a class="h-auto md:h-9 text-sm p-2 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold text-white rounded-lg"
                        href="{{ route('login') }}">
                        Login
                    </a>

                    <a class="h-auto md:h-9 text-sm p-2 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold text-white rounded-lg"
                        href="{{ route('register') }}">
                        Crear cuenta
                    </a>
                </nav>
            @endguest

        </div> {{-- .container --}}
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>

    @livewireScripts
    @stack('scripts')
</body>

</html>
