<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/b042223221.js" crossorigin="anonymous"></script>
    @stack("styles")
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Instagram | @yield("title")</title>
    @livewireStyles

</head>

<body class="bg-gray-100">

    <header class="p-5 border-b bg-white shadow">

        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                <a href=" {{ route('home') }}">Instagram</a>
            </h1>

            @auth
                <nav class="flex gap-2 items-center">
                    <a  class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm  cursor-pointer" href="{{route("posts.create")}}" >
                        Crear  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                    </a>

                    <a class=" text-gray-500 text-sm" href="{{route("posts.index", auth()->user()->username)}}">
                        Hola <span class="font-normal">{{auth()->user()->username}}</span>
                    </a>

                    <form action="{{route("logout")}}" method="post">
                        @csrf
                        <button  type ="submit" class=" text-gray-500 text-sm" href="{{route("logout")}}">Salir</button>
                    </form>
                   
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a class=" text-gray-500 text-sm" href="{{route("login")}}">Login</a>
                    <a class=" text-gray-500 text-sm" href="{{route("users.create")}}">Register</a>
                </nav>
                @endguest




        </div>

    </header>


    <main class="container mx-auto mt-10">
        <h2 class="text-center text-2xl mb-10">@yield("titulo")</h2>

        @yield("contenido")

    </main>

    <footer class="text-center p-5 text-gray-500 font-bold mt-10">

        <p> Instagram - Todos los derechos recervados {{date('Y')}}</p>
    </footer>

    @livewireScripts
</body>

</html>
