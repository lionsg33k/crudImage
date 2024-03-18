<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;


Route::get("/", [ImageController::class, "index"])->name("image.index");
Route::post("/image/store" , [ImageController::class , "store"])->name("image.store");
Route::put("/image/update/{image}" , [ImageController::class , "update"])->name("image.update");
Route::delete("/image/delete/{image}" , [ImageController::class , "destroy"])->name("image.delete");