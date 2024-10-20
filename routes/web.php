<?php
use Atova\Eshoper\Foundation\Http\Route;

Route::get("/",function(){
    return view("welcome");
});

Route::get("/dash/(\w+)",function($name){
    return view("web.dashboard",["name"=>$name]);
});