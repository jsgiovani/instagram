<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except(['show', 'index']);
    }
    
    public function index(User $user){

        return view('layouts.dashboard', [
            "user" => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
      
        $request->validate([
            "titulo"=>"required",
            "descripcion"=>"required",
            "imagen"=>"required",
        ]);

        Post::create([
            "titulo" => $request->titulo,
            "descripcion" => $request->descripcion,
            "imagen" => $request->imagen,
            "user_id" => auth()->user()->id
        ]);

        return redirect()-> route('posts.index',  auth()->user()->username);

    }

    public function show(User $user,Post $post) {
        return view('posts.show', [
            "post" => $post, 
            "user" => $user
        ]);
    }


    public function destroy(User $user,Post $post) {
        $this->authorize("delete", $post);
        $post->delete();

        //eliminar imagen
        $img_path = public_path("uploads/".$post->imagen);
        if (File::exists($img_path)) {
            unlink($img_path);
        }
        

        return redirect()->route('posts.index',auth()->user()->username)->with("mensaje", "Post eliminado correctamente");
    }
}
