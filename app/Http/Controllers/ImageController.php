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

    public function url_store(Request $request){
        //* validate  url  
        request()->validate([
            "link"=>"required|url"
        ]);
        //* to get the content  of the url ex : if the url content is an  image  the  method get_file_content  take  the  image and store  it in a variable
        $imagelink = file_get_contents($request->link);
        //* take  the file extension 
        $excetion = pathinfo($request->link, PATHINFO_EXTENSION);
        //* generating file name 
        $filename = uniqid() . "." . $excetion;
        //*  download  the image and store  it in Public folder 
        Storage::put("public/img/" . $filename, $imagelink);
        //*  create database row 
        Image::create([
            "image"=>$filename,
        ]);
        return back();
    }
}
