<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function index(){
        $followings = auth()->user()->following->pluck("id")->toArray();
        $posts = Post::whereIn("user_id", $followings)->latest()->get();
        return view('principal', [
            "posts" => $posts
        ]);
    }
    
}
