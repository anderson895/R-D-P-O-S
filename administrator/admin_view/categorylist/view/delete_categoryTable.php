
<div class="table-responsive">
<table class="table  datanew">
<thead>
<tr>
<th>
<label class="checkboxs">
<!--<input type="checkbox" id="select-all">-->
<span class="checkmarks"></span>
</label>
</th>
<th>Category name</th>
<th>Description</th>
<th>Date Created</th>
<th>Date Edited</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
    

    $current_date = date("Y-m-d"); // Get the current date
$view_query = mysqli_query($connections, "
SELECT * from category where category_status='1'
");
       // where account_type='0'
       
       while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
           
           $category_id = $row["category_id"];
           $category_name = $row["category_name"];
           $category_status = $row["category_status"];
           $category_description=$row["category_description"];
           $category_date_created = $row["category_date_created"];
           $category_date_edited = $row["category_date_edited"];
           ?>
<tr>
<td>
<label class="checkboxs">
<!--<input type="checkbox">-->
<span class="checkmarks"></span>
</label>
</td>
<td class="productimgname">
<a href="javascript:void(0);" class="product-img">
<br><br>
</a>
<a href="javascript:void(0);"><?= $category_name?></a>
</td>
<td><?php echo (strlen($category_description) > 70) ? substr($category_description, 0, 70) . '...' : $category_description; ?></td>
<td><?= $category_date_created?></td>
<td><?php if($category_date_edited===NULL){ echo "Category unchanged";}else{ echo $category_date_edited;}?></td>
<td>
<a class="me-3" href="editcategory.php?category_id=<?=$category_id?>">
<img src="assets/img/icons/edit.svg" alt="img">
</a>
<a class="me-3 toglerDeleteCategory" data-cat_id=<?= $category_id?> data-acc_id="<?= $acc_id ?>" >
<img src="assets/img/icons/delete.svg" alt="img">
</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>



<script>$(".toglerDeleteCategory").on("click", function() {
    cat_id = $(this).attr('data-cat_id');
    acc_id = $(this).attr('data-acc_id');
  
    //$('#ssid').val(ssid);
    console.log(cat_id);

    Swal.fire({
        title: "Are you sure?",
        text: "Remove this product",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'categorylist/controller/delete_category.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    cat_id:cat_id,
                    acc_id:acc_id,
                    category_status: 0
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                    Swal.fire({
                        type: "success",
                        title: "Deleted!",
                        text: "Your category has been removed.",
                        confirmButtonClass: "btn btn-success"
                    }).then(function() {
                       location.reload();
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