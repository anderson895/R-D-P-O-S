
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Purchase Add</h4>
<h6>Add/Update Purchase</h6>
</div>
</div>


<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Supplier Name</label>
<div class="row">
<div class="col-lg-10 col-sm-10 col-10">
<select class="select" id="supplier" onchange="getPurchasedCartData()">
    <?php
    $view_query = mysqli_query($connections, "SELECT * FROM supplier"); 

    while($row = mysqli_fetch_assoc($view_query)){
      $spl_id = $row["spl_id"];
      $spl_name = $row["spl_name"];
    ?>
    <option value="<?= $spl_id ?>"><?= $spl_name ?></option>
    <?php } ?>
  </select>


</div>
    <div class="col-lg-2 col-sm-2 col-2 ps-0">
        <div class="add-icon">
        <a href="#" data-bs-toggle="modal" data-bs-target="#ModAddStocks" id="addToCart" class="toglerAddPurchase" data-spl_id="<?=$spl_id?>" style="z-index: 1050;"><img src="assets/img/icons/plus1.svg" alt="img"></a>
      </div>
    </div>
</div>
</div>
</div>




<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Product Name</label>
<select class="select" id="productName">
<?php
$current_date = date("Y-m-d");
$query = "SELECT
    product.prod_id,
    product.prod_name,
    product.prod_currprice,
    product.prod_unit_id,
    product.prod_image,
    unit.unit_name,
    COALESCE(SUM(IF(stocks.s_expiration = '0000-00-00' OR stocks.s_expiration > '$current_date', stocks.s_amount, 0)), 0) AS prod_stocks
FROM
    product
LEFT JOIN
    unit ON product.prod_unit_id = unit.unit_id
LEFT JOIN
    stocks ON product.prod_id = stocks.s_prod_id
GROUP BY
    product.prod_id;
";

$view_query = mysqli_query($connections, $query);


while($row = mysqli_fetch_assoc($view_query)){ 
    $prod_id = $row["prod_id"];
    $prod_code = $row["prod_code"];
    $prod_name = $row["prod_name"];
    $prod_status = $row["prod_status"];
    $prod_currprice = $row["prod_currprice"];
    $prod_image = $row["prod_image"];

    $prod_currpriceFormatted="₱ ".number_format($prod_currprice,2);

    $prod_stocks = $row["prod_stocks"];
    $unit_name=$row["unit_name"];
    
    
?>
<option value="<?=$prod_id?>" 
data-unitname="<?=$unit_name?>" 
data-prod_currprice="<?=$prod_currpriceFormatted?>" 
data-prod_stocks="<?=$prod_stocks?>"
data-prod_image="<?=$prod_image?>"
>

<?=$prod_name?>
</option>
<?php } ?>
</select>
</div>
</div>


<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Reference No.</label>
<input type="text" id="referenceNo" >
</div>
</div>


<div hidden class="col-lg-12 col-sm-6 col-12">
    <div class="form-group">
        <label>Product Name</label>
    <div class="input-groupicon">
         <input type="text" placeholder="Scan/Search Product by code and select...">
    <div class="addonset">
        <img src="assets/img/icons/scanners.svg" alt="img">
    </div>
</div>

</div>
</div>
</div>



<div class="row">
<div id="purchasedcartTable" class="table-responsive">


<table class="table">
<thead>
<tr>
<th>Supplier Name</th>
<th>Product Name</th>
<th>QTY</th>
<th>Purchase Price(₱)	</th>
<th>Expiration</th>
<th>Discount (₱)	</th>
<th>Tax %</th>
<th>Tax Amount (₱)</th>

<th class="text-end">Total Cost (₱)	</th>
<th></th>
</tr>
</thead>

<tbody>
</tbody>
</table>

</div>
</div>
<hr>



<div class="col-lg-12">
<button id="purchasedButton" class="btn btn-submit submitPurchased me-2">Purchased</button>

<a href="purchaselist.php" class="btn btn-cancel">Cancel</a>
</div>

</div>


</div>
</div> 
</div> 






<?php include "managestocks/view/modal.php";?>
