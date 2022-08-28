<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller

{

    public function __construct(){
        $this->middleware("auth")->except(["create", "store"]);
    }


    public function create(){
        return view('auth.create');
    }

    public function store(Request $request){
        $username = Str::slug($request->get("username"));

        $request->merge([
            'username' => $username,
        ]);
        
        $request->validate([
            "name" => "required|max:30",
            "username" => "required|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:6",
            "password_confirmation" => "required"
        ]);

        User::create([
           "name" => $request->name,
           "username" => $request->username,
           "email" => $request->email,
           "password" => Hash::make($request->password)
        ]);

        //iniciar sesion
        auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        return redirect()->route('posts.index', $request->get("username"));
       
       
    }

    public function index(){
      return view('auth.index');
    }

    public function update(Request $request){
        $request->validate([
            "name" => "required|max:30",
        ]);

      if ($request->image) {
        $image = $request->file('image');
        $img_name = Str::uuid() . "." . $image->extension();
        $image = Image::make($image)->fit(1000, 1000, null, null);
        $img_path = public_path("uploads/profiles") . "/" . $img_name;
        $image->save($img_path);
      }

      $usuario = User::find(auth()->user()->id);

      if ($usuario->img){
        $img_path = public_path("uploads/profiles/".$usuario->img);
        if (File::exists($img_path)) {
            unlink($img_path);
        }
      }


      $usuario->name = $request->name;
      $usuario->img = $img_name;
      $usuario->update();

      return redirect()->route('posts.index', auth()->user()->username);
      }
}
