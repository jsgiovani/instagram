<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request,User $user, Post $post){
        $request->validate([
            "comentario" => "required|max:500"
        ]);

        
        Comentario::create([
            "comentario" => $request->comentario,
            "user_id" => auth()->user()->id,
            "post_id" => $post->id
        ]);


        return back()->with("mensaje","Comentario agregado exitosamente");
    }
}
