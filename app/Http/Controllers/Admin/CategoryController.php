<?php
namespace App\Http\Controllers\Admin;

use App\Models\CategoryModel;

use function Symfony\Component\String\b;

class CategoryController{
    public function index(){
        $data['scripts'] =[
            asset('admin/js/category.js'),
        ];
        
        return view("admin.category.index",$data);
    }
    public function create(){
        return view("admin.category.create");
    }

    public function store(){
        $data = $_POST;
        $image = $_FILES["image"];

        session()->flash('old', $data);

        $errors = [];

        if(empty($data['category_name'])){
            $errors['category_name_error'] = 'The category name field is required.';
        }
        if(empty($data['status'])){
            $errors['status_error'] = 'The category status field is required.';
        }
        if(empty($data['is_featured'])){
            $errors['is_featured_error'] = 'The is featuerd field is required.';
        }

        if(empty($image['name'])){
            $errors['image_error'] = 'The image field is requried.';
        }

        
        $supportedFileTypes = ['png','jpg','jpeg'];

        if(!empty($image['name']) && !in_array( pathinfo($image['full_path'],PATHINFO_EXTENSION),$supportedFileTypes)){
            $errors['image_error'] = 'The image type does not supported.';
        }

        if(!empty($image['name']) && $image['size'] > 2*MB){
            $errors['image_error'] = 'The image size should not greater than 2MB.';
        }


        if(!empty($errors)){
            session()->flash('validation_error', $errors);
            return redirectTo('category/create');
        }
        
        $ext = pathinfo($image['full_path'],PATHINFO_EXTENSION);
        $imageName = time().'.'.$ext;
        $directory = getUploadDirectory("category");

        if(!is_dir($directory)){
            mkdir($directory,777, true);
        }
        $absoluteFileName = $directory."/".$imageName;

        if(!move_uploaded_file($image['tmp_name'],$absoluteFileName)){
            session()->flash("error","Something went wrong with uploading file.");
            return redirectTo('category/create');    
        }

        $data['image'] = "category/".$imageName;

        $model = new CategoryModel();
        $hasStored = $model->store($data);

        if(is_string($hasStored)){
            session()->flash("error","Category create operation failed. Error is: ".$hasStored);
            unlink($absoluteFileName);
            return redirectTo('category/create');
        }

        session()->remove('old');
        session()->flash('success','Category successfully added');
        return redirectTo('category');
    }

    public function edit($id){ 
        session()->flash('success','Category successfully updated. ID is: '.$id);
        return redirectTo('category');
    }
    public function destroy($id){ 
        session()->flash('success','Category successfully deleted. ID is: '.$id);
        return redirectTo('category');
    }


    public function fetchCategories(){

        $limit = isset($_GET['limit']) ? $_GET['limit'] :10;
        $page  = isset($_GET['page']) ? $_GET['page'] :1;
        $offset = ($page -1) * $limit;
        $model = new CategoryModel();
        $categories = $model->getPaginatedCategories($offset, $limit);
        $totalCategories = $model->getTotalCategoriesCount();
        
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