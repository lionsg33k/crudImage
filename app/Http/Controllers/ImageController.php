<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //
    public function index()
    {

        $images = Image::all();
        return view('welcome', compact("images"));
    }


    //* store image

    public function store(Request $request)
    {
        request()->validate([
            "image" => "required|mimes:png,jpg|max:2048"
        ]);

        $image = $request->file("image");
        $filename =  $image->hashName();
        $image->storeAs("public/img/" . $filename);

        Image::create([
            "image" => $filename
        ]);

        return back();
    }


    //* update  image 

    public function update(Request $request, Image $image)
    {
        request()->validate([
            "image" => "required|mimes:png,jpg|max:2048"
        ]);

        $uploadedFile = $request->file("image");


        //* method 1
        // $filename =  $uploadedFile->hashName();
        // $uploadedFile->storeAs("public/img/" . $filename);


        // Storage::disk("public")->delete("img/" . $image->image);

        // $image->update([
        //     "image" => $filename
        // ]);

        //* method 2
        $uploadedFile->move("storage/img", $image->image);

        return back();
    }



    public function destroy(Image $image)
    {
        Storage::disk("public")->delete("img/" . $image->image);
        $image->delete();
        return back();
    }
}
