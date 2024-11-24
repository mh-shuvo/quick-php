<?php
namespace App\Models;
use Atova\Eshoper\Foundation\Models\Model;
use PDO;
class BrandModel extends Model{
    protected $table = "brands";

    public function getAllBrands(){
        $query = "SELECT * FROM `{$this->table}` ORDER BY `id` DESC";
        $this->query( $query );

        if($this->getErrors()){
            return $this->getErrors();
        }
        
        return $this->results();

    }

    public function getPaginatedBrand($offset, $limit){
        $query = "SELECT * FROM {$this->table} ORDER BY `id` DESC LIMIT :limit OFFSET :offset";
        $this->query( $query );
        $this->bind("limit", $limit, PDO::PARAM_INT );
        $this->bind("offset", $offset, PDO::PARAM_INT );
        
        if($this->getErrors()){
            return $this->getErrors();
        }
        return $this->results();
    }

    public function getTotalBrandCount()
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
        $sql = "INSERT INTO {$this->table} (`brand_name`,`logo`,`status`,`is_featured`) VALUES (:name,:img,:status,:isfeat)";  
        $this->query( $sql );
        $this->bind("name", $data["brand_name"] );
        $this->bind("img", $data["logo"] );
        $this->bind("status", $data["status"] );
        $this->bind("isfeat", $data["is_featured"] );
        
        $this->execute();

        if( $this->getErrors()){
            return $this->getErrors();
        }
        return true;
    }
    public function update($data){
        $sql = "UPDATE `{$this->table}` SET `brand_name`=:name,`logo`=:logo,`status`=:status,`is_featured`=:is_featured WHERE `id`=:id";
        $this->query($sql);
        $this->bind("id",$data['id'],PDO::PARAM_STR);
        $this->bind("name",$data['brand_name'],PDO::PARAM_STR);
        $this->bind("logo",$data['logo'],PDO::PARAM_STR);
        $this->bind("status",$data['status'],PDO::PARAM_STR);
        $this->bind("is_featured",$data['is_featured'],PDO::PARAM_STR);
        $this->execute();
        if($this->getErrors()){
            return ''. $this->getErrors();
        }
        return true;
    }

    public function getBrandById($id,$filelds="*"){
        $sql = "SELECT {$filelds} FROM {$this->table} WHERE `id`=:id;";
        $this->query($sql);
        $this->bind("id",$id);

        if ($this->getErrors()) {
            return "Something went wrong. The Error is: " . $this->getErrors();
        }

        // Fetching a single result as an object with the 'results' method (not an array)
        $result = $this->results(false);

        return $result ?? false;
    }
}