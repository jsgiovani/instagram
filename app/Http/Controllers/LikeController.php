<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request,Post $post){
       Like::create([
            "user_id" =>auth()->user()->id,
            "post_id" => $post->id
       ]);


       return redirect()->route('posts.show',[auth()->user()->username, $post->id]);
    }

    public function destroy(Request $request,Post $post){
      //  dd($post->user_id);
        $like = Like::where("user_id",$post->user_id);
       $like->delete();
       return back();

    }
}
