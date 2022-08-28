@extends('layouts.app')

@section('title', $post->titulo)

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset("uploads/$post->imagen") }}" alt="foto imagen">

            <div class="p-3 flex ">

                @auth
                    <livewire:like-post :post="$post" />

                @endauth


            </div>


            <div>
                <p class="font-bold">{{ $user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>

            @auth
                @if (auth()->user()->id == $post->user_id)
                    <form action=" {{ route('posts.destroy', [auth()->user()->username, $post]) }} " method="post">
                        @csrf
                        @method('delete')
                        <input
                            class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer  p-2 text-white text-sm rounded-lg mt-4"
                            type="submit" value="Eliminar post">
                    </form>
                @endif

            @endauth

        </div>





        <div class="md:w-1/2 p-5">
            @auth

                <div class="shadow mb-5 bg-white p-6 rounded-lg shadow-lx">
                    <p class="font-bold text-xl text-center mb-4">Agrega un nuevo comentario</p>
                    @if (session('mensaje'))
                        <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ session('mensaje') }}</p>
                    @endif
                    <form method="post" action="{{ route('comentarios.store', [$user, $post]) }}">
                        @csrf
                        <div class="mb-5 mr-5">
                            <textarea class="border p-3 w-full rounded-lg @error(' comentario') border-red-500 @enderror" id="comentario"
                                name="comentario" placeholder="Agrega una comentario"></textarea>

                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">*{{ $message }}</p>
                            @enderror
                        </div>

                        <input
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white text-sm rounded-lg"
                            type="submit" value="Comentar">
                    </form>
                </div>

            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                @if ($post->comentarios->count() > 0)

                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a class="font-bold" href="{{ route('posts.index', $comentario->user) }}">
                                <p>{{ $comentario->user->username }}</p>
                            </a>

                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center">No hay comentarios</p>
                @endif
            </div>




        </div>





    </div>

@endsection
