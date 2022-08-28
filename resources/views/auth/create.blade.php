@extends("layouts.app")

@section("title", "Register")

@section("titulo")
    
@endsection


@section("contenido")

<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-4/12 p-5">
        <img class="" src="{{asset("img/registrar.jpg")}}" alt="Imagen login">
    </div>

    <div class="md:w-3/12 bg-white p-6 rounded-lg shadow-lx">
        <form action="{{route("users.store")}}" method="POST" novalidate>
            @csrf
            <div class = "mb-5">
                <input class="border p-3 w-full rounded-lg @error("name") border-red-500 @enderror" type="text" name="name" id="name" placeholder="Nombre" value="{{old('name')}}">
                @error("name")
                    <p class="text-red-500  text-sm">*{{$message}}</p>
                @enderror
            </div>


            <div class = "mb-5">
                <input class="border p-3 w-full rounded-lg  @error("username") border-red-500 @enderror" type="text" name="username" id="username" placeholder="Nombre de usuario" value="{{old('username')}}">
                @error("username")
                <p class="text-red-500  text-sm">*{{$message}}</p>
            @enderror
            </div>


            <div class = "mb-5">
                <input class="border p-3 w-full rounded-lg  @error("email") border-red-500 @enderror" type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                @error("email")
                <p class="text-red-500  text-sm">*{{$message}}</p>
            @enderror
            </div>


            
            <div class = "mb-5">
                <input class="border p-3 w-full rounded-lg  @error("password") border-red-500 @enderror" type="password" name="password" id="password" placeholder="Password">
                @error("password")
                <p class="text-red-500  text-sm">*{{$message}}</p>
            @enderror
            </div>

            
            <div class = "mb-5">
                <input class="border p-3 w-full rounded-lg  @error("password_confirmation") border-red-500 @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar password">
                @error("password_confirmation")
                <p class="text-red-500  text-sm">*{{$message}}</p>
            @enderror
            </div>

            <input  class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer  w-full p-3 text-white rounded-lg" type="submit" value="Registrar">

        </form>
    </div>


</div>

   
@endsection