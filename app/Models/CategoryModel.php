<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Models\Model;

class CategoryModel extends Model{
    protected $table = "categories";

    public function getAllCategories(){
        $query = "SELECT * FROM `{$this->table}` ORDER BY `id` DESC";
        $this->query( $query );

        if($this->getErrors()){
            return $this->getErrors();
        }
        
        return $this->results();

    }

    public function store( $data ){
        $sql = "INSERT INTO {$this->table} (`category_name`,`image`,`status`,`is_featured`) VALUES (:name,:img,:status,:isfeat)";  
        $this->query( $sql );
        $this->bind("name", $data["category_name"] );
        $this->bind("img", $data["image"] );
        $this->bind("status", $data["status"] );
        $this->bind("isfeat", $data["is_featured"] );
        
        $this->execute();

        if( $this->getErrors()){
            return $this->getErrors();
        }
        return true;
    }

}