@extends("layouts.app")

@push("styles")
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section("title", "Nuevo post")

@section("titulo")
Nuevo post
@endsection


@section("contenido")

<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">

        <!-- Example of a form that Dropzone can take over -->
    <form action="{{route("images.store")}}" class="dropzone text-center border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-start " id="dropzone" enctype="multipart/form-data" method="post">
        @csrf
    
    </form>
    </div>


    <div class="md:w-1/2 px-10  bg-white p-6 rounded-lg shadow-lx">

        <form method="post" action="{{route("posts.store")}}" novalidate>
            @csrf
            <div class="mb-5 mr-5">
                <input class="border p-3 w-full rounded-lg @error("titulo") border-red-500 @enderror " type=" text"
                    id="titulo" name="titulo" placeholder="Titulo de tu post" value="{{old("titulo")}}">

                    @error("titulo")
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">*{{$message}}</p>
                    @enderror
            </div>



            <div class="mb-5 mr-5">
                <textarea class="border p-3 w-full rounded-lg @error("descripcion") border-red-500 @enderror" 
                    id="descripcion" name="descripcion" placeholder="Agrega una descripcion">{{old("descripcion")}}</textarea>

                    @error("descripcion")
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">*{{$message}}</p>
                    @enderror
            </div>


            <div class="mb-5 mr-5">
      
                    <input type="hidden" name="imagen" id="imagen" value="{{old("imagen")}}">

                    @error("imagen")
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >*{{$message}}</p>
                    @enderror
            </div>

            <input
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white text-sm rounded-lg  "
                type="submit" value="Publicar post">

        </form>

    </div>
</div>

@endsection
