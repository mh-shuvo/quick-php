<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Models\Model;

class CategoryModel extends Model{
    protected $table = "categories";

    public function getAllCategories(){
        $query = "SELECT * FROM `{$this->table}`";
        $this->query( $query );

        if($this->getErrors()){
            return $this->getErrors();
        }
        
        return $this->results();

    }

}