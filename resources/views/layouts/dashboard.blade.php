@extends('layouts.app')

@section('title', 'Muro')


@section('titulo')
    Perfil: {{ $user->username }}

@endsection


@section('contenido')
    <div class="flex justify-center">

        @if (session('mensaje'))
            <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
        @endif

        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="@if ($user->img) {{ asset("uploads/profiles/$user->img") }}
                @else 
                    {{ asset('img/usuario.svg') }} @endif"
                    alt="User logo">
            </div>
            <div
                class="md:w-8/12  2 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">


                <div class="flex gap-2 items-center">

                    <p class="text-gray-700 text-2xl text-center">{{ $user->username }}</p>


                    @auth

                        @if ($user->id === auth()->user()->id)
                            <a class=" text-gray-500 hover:text-gray-600 cursor-pointer" href=" {{ route('users.index') }} ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold"> {{ $user->followers->count() }} <span class="font-normal">Seguidores</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold"> {{  $user->following->count() }} <span class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm mb-3 font-bold"> {{ $user->posts->count() }} <span
                        class="font-normal">Posts</span></p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if ($user->siguiendo(auth()->user()))
                            <form action=" {{ route('followers.destroy', $user) }} " method="post">
                                @csrf
                                @method('delete')

                                <input type="submit" value="Dejar de seguir"
                                    class="bg-red-600 text-white rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">

                            </form>
                        @else
                            <form action=" {{ route('followers.store', $user) }}" method="post">
                                @csrf
                                <input type="submit" value="Seguir"
                                    class="bg-blue-600 text-white rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">

                            </form>
                        @endif
                    @endif
                @endauth


                @auth
                    @if ($user->id !== auth()->user()->id)
                    @endif
                @endauth


            </div>

        </div>
    </div>



    <section class="container mx-auto mt-10">
        <h2 class="text-axl text-center font-black my-10">Publicaciones</h2>



        @if ($user->posts->count())

            <div class="grid md:grid-cols-2 lg:grid-colos-3 xl:grid-cols-4 gap-6">
                @foreach ($user->posts as $post)
                    <div>


                        <a href="{{ route('posts.show', [$user, $post]) }}">
                            <img src="{{ asset("uploads/$post->imagen") }}" alt="{{ $post->imagen }}">
                        </a>
                    </div>
                @endforeach


            </div>
        @else
            <p class="text-gray-600 uppercase text-center text-sm ">No hay posts </p>
        @endif



    </section>
@endsection
