<?php
includeComponents("includes.admin.header",$data['styles']??[]);
includeComponents("includes.admin.sidebar");
$validationErrors = session()->getFlash("validation_error");
$old = session()->getFlash("old");
$category = $data['category'] ?? [];
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit <?=$category->category_name?></li>
        </ol>
        
        <div class="row">
            <div class="col-sm-12">
                <span class="text-danger fw-bold"><?=session()->getFlash('error')?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="<?= url('category/update') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$category->id?>">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" value="<?=$old['category_name'] ?? $category->category_name?>">
                        <span class="text-danger"><?=$validationErrors['category_name_error'] ?? null?></span>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image <sup>File type should be jpg, jpeg, png. And size is not greater than 2MB</sup> </label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="text-danger"><?=$validationErrors['image_error'] ?? null?></span> <br>
                        <img src="<?=getFileUrl($category->image)?>" alt="" style="height:100px;">
                    </div>

                    <div class="mb-3">
                        <label for="is_featured" class="form-label">Show as featuerd?</label>
                        <select class="form-select" id="is_featured" name="is_featured">
                            <option value="">Select one</option>
                            <option <?= (isset($old['is_featured']) && $old['is_featured'] == true) || $category->is_featured == true ?"selected":"" ?>  value="<?=(int)true?>">Yes</option>
                            <option <?= (isset($old['is_featured']) && $old['is_featured'] == false) || $category->is_featured == false?"selected":"" ?> value="<?=(int)false?>">No</option>
                        </select>
                        <span class="text-danger"><?=$validationErrors['is_featured_error'] ?? null?></span>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Select one</option>
                            <option <?= (isset($old['status']) && $old['status'] == "ACTIVE") || $category->status == "ACTIVE" ?"selected":"" ?>  value="ACTIVE">Active</option>
                            <option <?= (isset($old['status']) && $old['status'] == "INACTIVE") || $category->status == "INACTIVE" ?"selected":"" ?>  value="INACTIVE">Inactive</option>
                        </select>
                        <span class="text-danger"><?=$validationErrors['status_error'] ?? null?></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Category</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
includeComponents("includes.admin.footer",staticFiles: $data['scripts']??[]);
?>