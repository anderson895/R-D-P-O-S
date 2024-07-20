
<form method="POST" enctype="multipart/form-data">
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4> Product Category</h4>
<h6>add new product category</h6>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-6 col-sm-6 col-12">
<div class="form-group">
    
<input hidden type="text" name="acc_id" value="<?= $db_acc_id?>">
<label>Category Name</label>
<input type="text" value="" name="catname">
<div style="display:none;" class="alert alert-danger" id="errorcatname"></div>
</div>
</div>

<div class="col-lg-12">
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="catdescript" id="catdescript"></textarea>
<div style="display:none;" class="alert alert-danger" id="errorCatDescription"></div>
</div>
</div>


<div class="col-lg-12">
<button type="submit" class="btn btn-submit me-2" name="btnSubmit" id="btnSubmit">Submit</button>
<a href="categorylist.php" class="btn btn-cancel">Cancel</a>
</div>
</div>
</div>
</div>
</form>
<script src='addcategory/controller/add_category_validation.js'></script>