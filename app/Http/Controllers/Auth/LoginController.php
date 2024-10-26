<?php
namespace App\Http\Controllers\Auth;
class LoginController{
    public function index(){
        return view("auth.login");
    }
}