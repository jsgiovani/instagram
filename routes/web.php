<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, "index"])->name('home');


Route::get('/register',[UserController::class,"create"])->name("users.create");
Route::post('/register',[UserController::class,"store"])->name("users.store");



//editando perfil

Route::get('/edit',[UserController::class,"index"])->name("users.index");
Route::put('/edit',[UserController::class,"update"])->name("users.update");


Route::get('/login',[LoginController::class,"index"])->name("login");
Route::post('/login',[LoginController::class,"store"]);

Route::post('/logout',[LogoutController::class,"logout"])->name("logout");
Route::get('/logout',[LogoutController::class,"logout"]);


Route::get('/{user}',[PostController::class,"index"])->name("posts.index");
Route::get('/posts/create',[PostController::class,"create"])->name("posts.create");
Route::post('/posts',[PostController::class,"store"])->name("posts.store");
Route::get('/{user}/posts/{post}',[PostController::class,"show"])->name("posts.show");
Route::delete('/{user}/posts/{post}',[PostController::class,"destroy"])->name("posts.destroy");

Route::post("/image",[ImagenController::class,"store"])->name("images.store");



Route::post("/{user}/posts/{post}", [ComentarioController::class, "store"])->name("comentarios.store");


Route::post("/posts/{post}/likes", [LikeController::class, "store"])->name("likes.store");

Route::delete("/posts/{post}/likes", [LikeController::class, "destroy"])->name("likes.destroy");


//siguiendo usuario

Route::get("{user}/follow", [FollowerController::class, "index"])->name("followers.index");
Route::post("{user}/follow", [FollowerController::class, "store"])->name("followers.store");
Route::delete("{user}/follow", [FollowerController::class, "destroy"])->name("followers.destroy");