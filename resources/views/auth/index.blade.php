@extends('layouts.app')

@section('title', 'Edit')

@section('titulo')
    Editar usuario
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">

        <div class=" bg-white p-6 rounded-lg shadow-lx">
            <form action="{{ route('users.update') }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="mb-5">
                    <input class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" ty pe="text"
                        name="name" id="name" placeholder="Nombre" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <p class="text-red-500  text-sm">*{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-5">
                    <input class="border p-3 w-full rounded-lg"   type="file" accept=".jpg, .png, .jpeg" name="image">
                </div>

                <input
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer  w-full p-3 text-white rounded-lg"
                    type="submit" value="Actualizar">

            </form>
        </div>


    </div>


@endsection
