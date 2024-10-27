<?php
namespace App\Http\Controllers\Auth;
use App\Models\UserModel;
class LoginController{
    public function index(){
        if(session()->has(config("app.ADMIN_LOGIN_AUTH_KEY"))){
            return redirectTo("dashboard");
        }
        return view("auth.login");
    }

    public function loginAttempt(){
        $data = $_POST;
        $errors = [];

        if(is_null($data['email']) || $data['email'] == '' ){
            $errors['email_error']  = "The Email field is required";
        }
        
        if(is_null($data['password']) || $data['password'] == '' ){
            $errors['password_error']  = "The Password field is required";
        }

        if(!empty($errors)){
            session()->flash("login_validation_error", $errors);
            return redirectTo("login");
        }

        $user  = new UserModel();
        $hasLogin = $user->loginAttempt($data);
        
        if(!is_object( $hasLogin )){
            session()->flash("error", $hasLogin);
            return redirectTo("login");
        }

        session()->set(config("app.ADMIN_LOGIN_AUTH_KEY"),[
            "id" => $hasLogin->id,
            "name" => $hasLogin->name
        ]);
        return redirectTo("dashboard");
       
    }
    
}