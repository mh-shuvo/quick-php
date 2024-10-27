<?php
use Atova\Eshoper\Foundation\Http\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
Route::get("/",function(){
    return view("welcome");
});

Route::get("/dash/(\w+)",function($name){
    return view("web.dashboard",["name"=>$name]);
});

Route::get("/login",[LoginController::class,"index"]);
Route::post("/login-attempt",[LoginController::class,"loginAttempt"]);
Route::get("/dashboard",[AdminController::class,"index"]);
Route::post("/logout",[AdminController::class,"logout"]);