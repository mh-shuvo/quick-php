<?php
use Atova\Eshoper\Foundation\Http\Route;
use App\Http\Controllers\Auth\LoginController;
Route::get("/",function(){
    return view("welcome");
});

Route::get("/dash/(\w+)",function($name){
    return view("web.dashboard",["name"=>$name]);
});

Route::get("/login",[LoginController::class,"index"]);