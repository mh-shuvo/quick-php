<?php
includeComponents("includes.admin.header",$data['styles']??[]);
includeComponents("includes.admin.sidebar");
?>
<main>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-10">
                <h1 class="mt-4">Category</h1>
            </div>
            <div class="col-2 text-right">
                    <a href="<?=url("category/create")?>" class="btn btn-primary btn-md mt-4">Add new Category</a>
            </div>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Category List</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <span class="text-success fw-bold"><?=session()->getFlash('success')?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="pagination"></div>
            </div>
        </div>
    </div>
</main>
<?php
includeComponents("includes.admin.footer",staticFiles: $data['scripts']??[]);
?>