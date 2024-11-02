<?php
namespace App\Http\Controllers\Admin;

use App\Models\CategoryModel;

class CategoryController{
    public function index(){
        $data['scripts'] =[
            asset('admin/js/category.js'),
        ];
        $model = new CategoryModel();
        $categories = $model->getAllCategories();

        if(!is_array($categories)){
            handleException($categories);
        }

        $data['categories'] = $categories;

        return view("admin.category.index",$data);
    }
    public function create(){
        return view("admin.category.create");
    }
}