<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Models\Model;
use PDO;

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

    public function getPaginatedCategories($offset, $limit){
        $query = "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT :limit OFFSET :offset";
        $this->query( $query );
        $this->bind("limit", $limit, PDO::PARAM_INT );
        $this->bind("offset", $offset, PDO::PARAM_INT );
        
        if($this->getErrors()){
            return $this->getErrors();
        }
        return $this->results();
    }

    public function getTotalCategoriesCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $this->query($sql);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        // Fetching a single result as an object with the 'results' method (not an array)
        $result = $this->results(false);

        return $result ? (int) $result->count : 0; // Return total count as integer
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