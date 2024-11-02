<?php
includeComponents("includes.admin.header",$data['styles']??[]);
includeComponents("includes.admin.sidebar");
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create New Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Category List</li>
            <li class="breadcrumb-item active">New Category</li>
        </ol>
        <div class="row">
            <div class="col-12">
                Hello
            </div>
        </div>
    </div>
</main>
<?php
includeComponents("includes.admin.footer",staticFiles: $data['scripts']??[]);
?>