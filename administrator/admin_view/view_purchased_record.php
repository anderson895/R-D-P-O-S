<?php
include "backend/back_navbar.php";
include "php/session_dir.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>View record</title>

<link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>


<div class="main-wrapper">

<div class="header">

            <?php include "topBar/header.php"; ?>

    <ul class="nav user-menu">
            <?php include "topBar/navMenu.php"; ?>
            <?php include "topBar/notification.php"; ?>
            <?php include "topBar/profile.php"; ?>
    </ul>

    <?php include "topbar/mobilUserMenu.php"; ?>
</div>
    <?php  include "Section/sidebar.php"; ?>
    
    <?php 
$precord_reference = mysqli_real_escape_string($connections, $_GET["precord_reference"]);

$get_record = mysqli_query($connections, "SELECT *,
    SUM(precord_qty*precord_price) AS subtotal,
    SUM(precord_discount) AS precord_discount,
    SUM(precord_Tax_Amount) AS Grandprecord_Tax_Amount,
    SUM(precord_Total_Cost) AS Grandprecord_Total_Cost
    FROM purchased_record 
    LEFT JOIN product ON purchased_record.precord_prod_id = product.prod_id
    LEFT JOIN supplier ON purchased_record.precord_sup_id = supplier.spl_id
    WHERE precord_reference = '$precord_reference'");
     
	$row = mysqli_fetch_assoc($get_record);
    $spl_name = $row["spl_name"];
    $precord_reference=$row["precord_reference"];

    $subtotal=$row["subtotal"];
    
    
    
$Grandprecord_discount=$row["precord_discount"];
$Grandprecord_Tax_Amount=$row["Grandprecord_Tax_Amount"];
$Grandprecord_Total_Cost=$row["Grandprecord_Total_Cost"];

    
    $precord_date = $row["precord_date"];
    $timestamp = strtotime($precord_date); // Convert the date to a Unix timestamp
    $formattedDate = date("d F Y h:i A", $timestamp); // Adds time in 12-hour format with AM/PM
    
?>
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Purchase record </h4>
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
<input disabled style="border:none; background-color:transparent;"  type="text" value="<?=ucfirst($spl_name) ?>">
</div>


</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Purchase Date </label>
<div class="input-groupicon">
<input disabled style="border:none; background-color:transparent;" type="text" placeholder="DD-MM-YYYY" value="<?=$formattedDate?>">

</div>
</div>
</div>




<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Reference No.</label>
<input disabled style="border:none; background-color:transparent;" type="text" value="<?= $precord_reference?>">
</div>
</div>






<div class="row">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Product Name</th>
<th>Qty</th>
<th>Unit</th>
<th>Price</th>
<th>Current price</th>
<th>profit</th>
<th>Expiration</th>
<th>Tax</th>
<th>Tax Amount</th>
<th class="text-end">Discount</th>
<th class="text-end">Total Cost</th>
<th class="text-end">Net Profit</th>
<th></th>
</tr>
</thead>
<tbody>

<?php
$view_query = mysqli_query($connections,"SELECT *
FROM purchased_record 
LEFT JOIN product ON purchased_record.precord_prod_id = product.prod_id
LEFT JOIN supplier ON purchased_record.precord_sup_id = supplier.spl_id
LEFT JOIN unit ON unit.unit_id = product.prod_unit_id
WHERE precord_reference = '$precord_reference'");
// where account_type='0'


while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
    
    $precord_reference=$row["precord_reference"];
    
    $prod_name=$row["prod_name"];
    $prod_image=$row["prod_image"];
    $precord_qty=$row["precord_qty"];
    $precord_price=$row["precord_price"];
    $precord_expiration=$row["precord_expiration"];
    $unitName=$row['unit_name'];
    $prod_currprice=$row['prod_currprice'];

    $eachProfit=$prod_currprice-$precord_price;

    $totalEachProfit=$eachProfit*$precord_qty;

   
    

    if($precord_expiration==="0000-00-00"){ $precord_expiration="N/A";}
    $precord_Tax=$row["precord_Tax"];
    $precord_Tax_Amount	=$row["precord_Tax_Amount"];
    $precord_discount=$row["precord_discount"];
    $precord_Total_Cost=$row["precord_Total_Cost"];

  

    $NetProfit=$totalEachProfit-$precord_Total_Cost;

?>
<tr>
<td class="productimgname">
<a class="product-img">
<img src="../../upload_prodImg/<?=$prod_image?>" alt="product">
</a>
<a href="javascript:void(0);"><?=$prod_name?></a>
</td>
<td><?=$precord_qty?></td>
<td><?=$unitName?></td>
<td><?=number_format($precord_price,2)?></td>
<td><?=number_format($prod_currprice,2)?></td>
<td><?=number_format($eachProfit,2)?></td>
<td><?=$precord_expiration?></td>
<td><?=$precord_Tax?></td>
<td><?=number_format($precord_Tax_Amount,2)?></td>
<td class="text-end"><?=number_format($precord_discount,2)?></td>
<td class="text-end"><?=number_format($precord_Total_Cost,2)?></td>
<td class="text-end"><?=number_format($NetProfit,2)?></td>

</tr>
<tr>
<?php
} ?>

</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="row">
<div class="col-lg-12 float-md-right">
<div class="total-order">
<ul>

<li>
<h4>Subtotal</h4>
<h5>₱ <?=number_format($subtotal,2)?></h5>
</li>

<li>
<h4>Order Tax</h4>
<h5>₱ <?=number_format($Grandprecord_Tax_Amount,2)?></h5>
</li>


<li>
<h4>Discount	</h4>
<h5>₱ <?=number_format($Grandprecord_discount,2)?></h5>
</li>
<li class="total">
<h4>Grand Total</h4>
<h5>₱ <?=number_format($Grandprecord_Total_Cost,2)?></h5>
</li>
</ul>
</div>
</div>
</div>


<div class="col-lg-12">
<a href="purchaselist.php" class="btn btn-cancel">Back</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>