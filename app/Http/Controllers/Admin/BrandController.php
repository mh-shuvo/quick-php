<?php
namespace App\Http\Controllers\Admin;

use App\Models\BrandModel;

use function Symfony\Component\String\b;

class BrandController{
    public function index(){
        $data['scripts'] =[
            asset('admin/js/brand.js'),
        ];
        
        return view("admin.brand.index",$data);
    }
    public function create(){
        return view("admin.brand.create");
    }

    public function store(){
        $data = $_POST;
        $logo = $_FILES["logo"];

        session()->flash('old', $data);

        $errors = [];

        if(empty($data['brand_name'])){
            $errors['brand_name_error'] = 'The brand name field is required.';
        }
        if(empty($data['status'])){
            $errors['status_error'] = 'The brand status field is required.';
        }
        if($data['is_featured'] == null || $data['is_featured']==""){
            $errors['is_featured_error'] = 'The is featuerd field is required.';
        }

        if(empty($logo['name'])){
            $errors['logo_error'] = 'The logo field is requried.';
        }

        
        $supportedFileTypes = SUPPORTED_FILE_TYPES;

        if(!empty($logo['name']) && !in_array( pathinfo($logo['full_path'],PATHINFO_EXTENSION),$supportedFileTypes)){
            $errors['logo_error'] = 'The logo type does not supported.';
        }

        if(!empty($logo['name']) && $logo['size'] > 2*MB){
            $errors['logo_error'] = 'The logo size should not greater than 2MB.';
        }


        if(!empty($errors)){
            session()->flash('validation_error', $errors);
            return redirectTo('brand/create');
        }
        
        $ext = pathinfo($logo['full_path'],PATHINFO_EXTENSION);
        $logoName = time().'.'.$ext;
        $directory = getUploadDirectory("brand");

        if(!is_dir($directory)){
            mkdir($directory,777, true);
        }
        $absoluteFileName = $directory."/".$logoName;

        if(!move_uploaded_file($logo['tmp_name'],$absoluteFileName)){
            session()->flash("error","Something went wrong with uploading file.");
            return redirectTo('brand/create');    
        }

        $data['logo'] = "brand/".$logoName;

        $model = new BrandModel();
        $hasStored = $model->store($data);

        if(is_string($hasStored)){
            session()->flash("error","Brand create operation failed. Error is: ".$hasStored);
            unlink($absoluteFileName);
            return redirectTo('brand/create');
        }

        session()->remove('old');
        session()->flash('success','Brand successfully added');
        return redirectTo('brand');
    }

    public function update(){
        $data = $_POST;
        $logo = $_FILES["logo"];
        session()->flash('old',$data);
        $errors = [];

        if(empty($data['brand_name'])){
            $errors['brand_name_error'] = 'The brand name field is required.';
        }
        if(empty($data['status'])){
            $errors['status_error'] = 'The brand status field is required.';
        }
        if($data['is_featured'] == null || $data['is_featured']==""){
            $errors['is_featured_error'] = 'The is featuerd field is required.';
        }
        $supportedFileTypes = SUPPORTED_FILE_TYPES;

        if(!empty($logo['name']) && !in_array( pathinfo($logo['full_path'],PATHINFO_EXTENSION),$supportedFileTypes)){
            $errors['logo_error'] = 'The logo type does not supported.';
        }

        if(!empty($logo['name']) && $logo['size'] > 2*MB){
            $errors['logo_error'] = 'The logo size should not greater than 2MB.';
        }
        
        // debugCode($data);

        if(!empty($errors)){
            session()->flash('validation_error', $errors);
            return redirectTo('brand/edit/'.$data['id']);
        }

        $previouslogo = $this->getPreviouslogoOfbrand($data['id']);

        if(!empty($logo['name'])){
            $ext = pathinfo($logo['full_path'],PATHINFO_EXTENSION);
            $logoName = time().'.'.$ext;
            $directory = getUploadDirectory("brand");

            if(!is_dir($directory)){
                mkdir($directory,777, true);
            }
            $absoluteFileName = $directory."/".$logoName;

            if(!move_uploaded_file($logo['tmp_name'],$absoluteFileName)){
                session()->flash("error","Something went wrong with uploading file.");
                return redirectTo('brand/edit/'.$data['id']);  
            }

            $data['logo'] = "brand/".$logoName;
        }else{
            $data['logo'] = $previouslogo;
        }

        $model = new BrandModel();
        $update = $model->update($data);

        if(is_string($update)){
            session()->flash('error','Something went wrong. Error: '.$update);
            unlink($absoluteFileName);
            return redirectTo('brand/edit/'.$data['id']);  
        }
        if(!empty($logo['name'])){
            deleteFile($previouslogo);
        }
        session()->flash('success','Brand successfully updated. ');
        return redirectTo('brand');

    }
    
    private function getPreviouslogoOfbrand($id){
        $model = new BrandModel();
        $previousData = $model->getBrandById($id,"logo");
        if(is_string($previousData) || $previousData == false){
            return null;
        }
        return $previousData->logo;
    }

    public function edit($id){ 
        $model = new BrandModel();
        $result = $model->getBrandById($id);

        if(is_string($result) || $result == false){
            session()->flash('error','Unknown brand. Error: '.$result);
            return redirectTo('brand');
        }
        $data = [
            "brand" => $result
        ];
        return view("admin.brand.edit",$data);
    }
    public function destroy($id){ 
        $previouslogo = $this->getPreviouslogoOfbrand($id);
        $model = new BrandModel();
        $hasDeleted = $model->delete($id);
        $response = [
            'status' => "success",
            "message" => "brand Successfully Deleted."
        ];
        $responseCode = 200;

        if(is_string($hasDeleted)){
            $response['status'] = "failed";
            $response['message'] = $hasDeleted;
            $responseCode = 500;
        }

        if($hasDeleted){
            deleteFile($previouslogo);
        }

        http_response_code($responseCode);
        echo json_encode($response);

    }


    public function fetchBrands(){

        $limit = isset($_GET['limit']) ? $_GET['limit'] :10;
        $page  = isset($_GET['page']) ? $_GET['page'] :1;
        $offset = ($page -1) * $limit;
        $model = new BrandModel();
        $categories = $model->getPaginatedBrand($offset, $limit);
        $totalCategories = $model->getTotalBrandCount();
        
        if(is_string($categories)){
            http_response_code(500);
            echo json_encode([
                'status' => 'failed',
                'message'=> 'Something went wrong during fetching data.',
                'error' => $categories
            ]);
        }
        http_response_code(200);
        echo json_encode([
            "status" => "success",
            "data" => $categories,
            "pagination" => [
                "total" => $totalCategories,
                "current_page" => $page,
                "per_page" => $limit,
                "total_pages" => ceil($totalCategories / $limit)
            ]
        ]);
    }
}