<?php
use Atova\Eshoper\Foundation\Http\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

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
Route::post("/category/update",[CategoryController::class,"update"]);

/** Brand */
Route::get("/brand",[BrandController::class,"index"]);
Route::get("/brand/create",[BrandController::class,"create"]);
Route::post("/brand/store",[BrandController::class,"store"]);
Route::get("/brand/edit/(\w+)",[BrandController::class,"edit"]);
Route::get("/brand/delete/(\w+)",[BrandController::class,"destroy"]);
Route::get("/fetch-brands",[BrandController::class,"fetchBrands"]);
Route::post("/brand/update",[BrandController::class,"update"]);