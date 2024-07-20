
<?php 
$category_id=$_GET["category_id"];


$get_record = mysqli_query ($connections,"SELECT *
FROM category
WHERE category_id = '$category_id' ");
		$row = mysqli_fetch_assoc($get_record);
		$category_id = $row["category_id"];
         $category_name = $row["category_name"];
         $category_description = $row["category_description"];
         $category_status = $row["category_status"];
         
         date_default_timezone_set('Asia/Manila');
         $currentDateTime = date('Y-m-d g:i:s A');     
?>


<form method="POST" enctype="multipart/form-data">
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Product Edit Category</h4>
<h6>Edit a product Category</h6>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-6 col-sm-6 col-12">
<div class="form-group">
<input hidden type="text" value="<?=$category_id?>" id="category_id">  
<input hidden type="text" name="acc_id" value="<?= $db_acc_id?>" id="acc_id">
<label>Category Name</label>
<input type="text" value="<?= $category_name?>" name="catname" id="catname">
<div style="display:none;" class="alert alert-danger" id="errorcatname"></div>
</div>
</div>

<div class="col-lg-12">
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="catdescript" id="catdescript"><?= $category_description?></textarea>
<div style="display:none;" class="alert alert-danger" id="errorCatDescription"></div>
</div>
</div>


<div class="col-lg-12">
<button type="button" class="btn btn-submit me-2 btnSubmit" name="btnSubmit" >Save</button>
<a href="categorylist.php" class="btn btn-cancel">Back</a>

<?php if($category_status=="0"){?> <button type="button" class="btn btn-cancel toglerRestoreCategory" data-cat_id=<?= $category_id?> data-acc_id=<?= $db_acc_id?>>Restore</button> <?php } ?>
</div>



</div>
</div>
</div>
</form>



<script>

$(".btnSubmit").on("click", function() {
    var acc_id = $("#acc_id").val();
    var catname = $("#catname").val();
    var catdescript = $("#catdescript").val();
    var category_id = $("#category_id").val();
    
    
    console.log(acc_id);

 //   acc_id = $(this).attr('data-acc_id');
  
    //$('#ssid').val(ssid);

    
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'editcategory/controller/editCategory.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    acc_id:acc_id,
                    catname:catname,
                    catdescript: catdescript,
                    category_id:category_id
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                  
                     // location.href = "categorylist.php";
                   console.log(response)
                   alertify.success("Category saved successful")
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the product.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
    
});


$(".toglerRestoreCategory").on("click", function() {
    cat_id = $(this).attr('data-cat_id');
    acc_id = $(this).attr('data-acc_id');
  
    //$('#ssid').val(ssid);
    console.log(acc_id);

    Swal.fire({
        title: "Are you sure?",
        text: "Restore this product",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, restore it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'editcategory/controller/restore.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    cat_id:cat_id,
                    acc_id:acc_id,
                    category_status: 1
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                    Swal.fire({
                        type: "success",
                        title: "Success!",
                        text: "Your category has been restore.",
                        confirmButtonClass: "btn btn-success"
                    }).then(function() {
                      // location.reload();
                      // Change the URL to "https://www.example.com"
                      location.href = "categorylist.php";

                    // console.log(response)
                    
                    });
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the product.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }
    });
});
</script>


<script src='editcategory/controller/edit_category_validation.js'></script>