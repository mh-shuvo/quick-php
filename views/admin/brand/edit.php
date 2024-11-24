<?php
includeComponents("includes.admin.header",$data['styles']??[]);
includeComponents("includes.admin.sidebar");
$validationErrors = session()->getFlash("validation_error");
$old = session()->getFlash("old");
$brand = $data['brand'] ?? [];
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Brand</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit <?=$brand->brand_name?></li>
        </ol>
        
        <div class="row">
            <div class="col-sm-12">
                <span class="text-danger fw-bold"><?=session()->getFlash('error')?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="<?= url('brand/update') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$brand->id?>">
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?=$old['brand_name'] ?? $brand->brand_name?>">
                        <span class="text-danger"><?=$validationErrors['brand_name_error'] ?? null?></span>
                    </div>
                    
                    <div class="mb-3">
                        <label for="logo" class="form-label">Brand Logo <sup>File type should be jpg, jpeg, png. And size is not greater than 2MB</sup> </label>
                        <input type="file" class="form-control" id="logo" name="logo">
                        <span class="text-danger"><?=$validationErrors['logo_error'] ?? null?></span> <br>
                        <img src="<?=getFileUrl($brand->logo)?>" alt="" style="height:100px;">
                    </div>

                    <div class="mb-3">
                        <label for="is_featured" class="form-label">Show as featuerd?</label>
                        <select class="form-select" id="is_featured" name="is_featured">
                            <option value="">Select one</option>
                            <option <?= (isset($old['is_featured']) && $old['is_featured'] == true) || $brand->is_featured == true ?"selected":"" ?>  value="<?=(int)true?>">Yes</option>
                            <option <?= (isset($old['is_featured']) && $old['is_featured'] == false) || $brand->is_featured == false?"selected":"" ?> value="<?=(int)false?>">No</option>
                        </select>
                        <span class="text-danger"><?=$validationErrors['is_featured_error'] ?? null?></span>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Select one</option>
                            <option <?= (isset($old['status']) && $old['status'] == "ACTIVE") || $brand->status == "ACTIVE" ?"selected":"" ?>  value="ACTIVE">Active</option>
                            <option <?= (isset($old['status']) && $old['status'] == "INACTIVE") || $brand->status == "INACTIVE" ?"selected":"" ?>  value="INACTIVE">Inactive</option>
                        </select>
                        <span class="text-danger"><?=$validationErrors['status_error'] ?? null?></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Update brand</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
includeComponents("includes.admin.footer",staticFiles: $data['scripts']??[]);
?>