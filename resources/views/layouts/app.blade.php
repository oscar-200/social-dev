<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Social Dev</title>
    @vite('resources/css/app.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">Social Dev</h1>
            <nav class="flex gap-2 items-center">
                @auth
                    <a class="font-bold text-gray-600 text-sm" href="{{ route('login') }}">
                        Hola <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>

                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar sesión</button>
                    </form>
                @endauth
                @guest
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Register</a>
                @endguest
            </nav>
        </div>

    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>
    <footer class=" text-center p-5 text-gray-500 font-bold uppercase">
        Social Dev - Todos los derechos reservados
        {{ now()->year }}
    </footer>

</body>

</html>
