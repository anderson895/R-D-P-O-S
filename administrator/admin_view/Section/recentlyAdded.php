
<div class="col-lg-5 col-sm-12 col-12 d-flex">
<div class="card flex-fill">
<div class="card-header pb-0 d-flex justify-content-between align-items-center">
<h4 class="card-title mb-0">Recently Added Products</h4>
<div class="dropdown">
<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
<i class="fa fa-ellipsis-v"></i>
</a>
<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<li>
<a href="productlist.html" class="dropdown-item">Product List</a>
</li>
<li>
<a href="addproduct.html" class="dropdown-item">Product Add</a>
</li>
</ul>
</div>
</div>
<div class="card-body">
<div class="table-responsive dataview">
<table class="table datatable ">
<thead>
<tr>
<th>Product Code</th>
<th>Products</th>
<th>Price</th>
</tr>
</thead>
<tbody>
    <?php
   $view_query = mysqli_query($connections, "SELECT * FROM product where prod_status='0' ORDER BY `prod_id` DESC LIMIT 4");

    
    // where account_type='0'
    
    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
        
        $prod_code = $row["prod_code"];
        $prod_name = $row["prod_name"];
        $prod_image = $row["prod_image"];
        $prod_currprice = $row["prod_currprice"];
    ?>
<tr>
<td><?= $prod_code?></td>
<td class="productimgname">
<a href="productlist.html" class="product-img">
<img src="../../upload_prodImg/<?= $prod_image?>" alt="product">
</a>
<a href="productlist.html"><?= $prod_name?></a>
</td>
<td>₱ <?php echo number_format($prod_currprice,2)?></td>
</tr>
        <?php } ?>


</tbody>
</table>
</div>
</div>
</div>
</div>
</div>