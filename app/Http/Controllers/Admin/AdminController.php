<?php 
namespace App\Http\Controllers\Admin;
class AdminController{
    
    public function index(){
        
        if(!session()->has(config("app.ADMIN_LOGIN_AUTH_KEY"))){
            return redirectTo("login");
        }
        return view("admin.dashboard");
    }

    public function logout(){
        session()->remove("ADMIN_LOGIN_AUTH");
        return redirectTo("login");
    }
}