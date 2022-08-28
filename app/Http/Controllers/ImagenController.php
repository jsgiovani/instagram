<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');
        $img_name = Str::uuid() . "." . $image->extension();
        $image = Image::make($image)->fit(1000, 1000, null, null);
        $img_path = public_path("uploads") . "/" . $img_name;
        $image->save($img_path);
        return response()->json(["img_name" => $img_name]);
        return response()->json($image);
    }
}
