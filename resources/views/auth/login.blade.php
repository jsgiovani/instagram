@extends("layouts.app")

@section("title", "Login")

@section("titulo")
Registro de nuevo usuario
@endsection


@section("contenido")

<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-4/12 p-5">
        <img class="" src="{{asset("img/login.jpg")}}" alt="Imagen login">
    </div>

    <div class="md:w-3/12 bg-white p-6 rounded-lg shadow-lx">
        <form action="{{route("login")}}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <input class="border p-3 w-full rounded-lg  @error(" email") border-red-500 @enderror" type="email"
                    name="email" id="email" placeholder="Email" value="{{old('email')}}">
                @error("email")
                <p class="text-red-500  text-sm">*{{$message}}</p>
                @enderror
            </div>



            <div class="mb-5">
                <input class="border p-3 w-full rounded-lg  @error(" password") border-red-500 @enderror"
                    type="password" name="password" id="password" placeholder="Password">
                @error("password")
                <p class="text-red-500  text-sm">*{{$message}}</p>
                @enderror
            </div>


            @if (session("error"))
            <p class="text-red-500  text-sm text-center mb-2">{{session("error")}}</p>

            @endif

            <input
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer  w-full p-3 text-white rounded-lg"
                type="submit" value="Ingresar">

        </form>
    </div>


</div>


@endsection
