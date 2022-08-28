<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(User $user, Request $request){
        //dd($request->all());
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);



        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with("error", "Datos invalidos, intente nuevamente");
        }

        return redirect()->route('posts.index',auth()->user()->username);

      
    }



}
