<?php
use Atova\Eshoper\Foundation\Http\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;

Route::get("/",function(){
    return view("welcome");
});

Route::get("/dash/(\w+)",function($name){
    return view("web.dashboard",["name"=>$name]);
});

/**
 * Login
 */
Route::get("/login",[LoginController::class,"index"]);
Route::post("/login-attempt",[LoginController::class,"loginAttempt"]);

/**Dashboard */
Route::get("/dashboard",[AdminController::class,"index"]);
Route::post("/logout",[AdminController::class,"logout"]);

/**Category */
Route::get("/category",[CategoryController::class,"index"]);
Route::get("/category/create",[CategoryController::class,"create"]);
Route::post("/category/store",[CategoryController::class,"store"]);
Route::get("/category/edit/(\w+)",[CategoryController::class,"edit"]);
Route::get("/category/delete/(\w+)",[CategoryController::class,"destroy"]);
Route::get("/fetch-categories",[CategoryController::class,"fetchCategories"]);