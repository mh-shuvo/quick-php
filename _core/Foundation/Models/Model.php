<?php
namespace Atova\Eshoper\Foundation\Models;
use Atova\Eshoper\Abstract\Database;

abstract class Model extends Database{
    protected $table = "";
    
    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE `id`=:id;";
        $this->query($sql);
        $this->bind("id",$id);
        $this->execute();
        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }
        return true;
    }
}