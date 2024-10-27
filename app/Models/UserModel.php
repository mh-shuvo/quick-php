<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Models\Model;

use function PHPSTORM_META\type;

class UserModel extends Model{
    protected $table = "users";

    public function loginAttempt($data):string|object{
        $sql = "SELECT * FROM `{$this->table}` WHERE `email`=:email AND `user_type`=:u_type";
        $this->query($sql);
        $this->bind("email", $data["email"]);
        $this->bind("u_type", "ADMIN");

        if($this->getErrors()){
            return $this->getErrors();
        }

        $user = $this->results(false);

        if($this->rowCount() == 0){
            return "User not found with the given credentials";
          }

        if(!password_verify($data["password"], $user->password)){
            return "Password do not match";
        }

        return $user;
    }
}