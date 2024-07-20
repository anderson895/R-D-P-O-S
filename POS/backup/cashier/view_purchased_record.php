<?php
include ('../config/config.php');
include ('../functions/session.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body >




<?php include ('../includes/navigation.php');?>



<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/alertify/alertify.min.css">
<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/icons/feather/feather.css">
<!---<link rel="stylesheet" href="../../administrator/admin_view/assets/css/bootstrap.min.css">----->

<link rel="stylesheet" href="../../administrator/admin_view/assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/css/animate.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/fontawesome/css/all.min.css">



<!---<link rel="stylesheet" href="../../administrator/admin_view/assets/css/style.css">---->

<div class="container">
    <div class="row">
        
   <!---main--->
   
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
    
    $subtotal=$row['subtotal'];
    
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
<br>
<h4>Purchase record </h4>
</div>
</div>

<div class="wordset mb-2 mt-2">
<ul>
    <li>
    <!---<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel1"><img src="../../administrator/admin_view/assets/img/icons/excel.svg" alt="img"></a>--->
         <button class="btn  border" data-bs-toggle="modal" data-bs-target="#export"><img src="../assets/images/export.png"  class="btn-img" alt=""> Export</button>
    </li>
    <li>
    <!--<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../../administrator/admin_view/assets/img/icons/printer.svg" alt="img"></a>--->
        <button class="btn  border" data-bs-toggle="modal" data-bs-target="#"><img src="../../administrator/admin_view/assets/img/icons/printer.svg" alt="img"></button>
    </li>
</ul>
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
<img src="../../upload_prodImg/<?=$prod_image?>" style='width:25px;' alt="product">
</a>
<a href="javascript:void(0);" style="color:black;"><?=ucfirst($prod_name)?></a>
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

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="total-order text-center">
                <div class="row">
                   <div class="col-md-3 border">
                        <h5>Subtotal</h5>
                        <h6>₱ <?=number_format($subtotal,2)?></h6>
                    </div>
                    <div class="col-md-3 border">
                        <h5>Order Tax</h5>
                        <h6>₱ <?=number_format($Grandprecord_Tax_Amount,2)?></h6>
                    </div>
                    <div class="col-md-3 border">
                        <h5>Discount</h5>
                        <h6>₱ <?=number_format($Grandprecord_discount,2)?></h6>
                    </div>
                    <div class="col-md-3 total border">
                        <h5>Grand Total</h5>
                        <h6>₱ <?=number_format($Grandprecord_Total_Cost,2)?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-12 mt-4">
<a href="listpurchase.php" class="btn btn-secondary">Back</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
   <!--end main ---->
        
    </div>
    
</div>











<script src="../assets/js/prevent_negative_numbers.js"></script>
<script src="../assets/js/login-loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="managestocks/javascript/toglerRemoveFromCart.js"></script>




<script src="../../administrator/admin_view/assets/js/jquery-3.6.0.min.js"></script>

<script src="../../administrator/admin_view/assets/js/feather.min.js"></script>

<script src="../../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="../../administrator/admin_view/assets/js/jquery.dataTables.min.js"></script>
<script src="../../administrator/admin_view/assets/js/dataTables.bootstrap4.min.js"></script>

<script src="../../administrator/admin_view/assets/js/bootstrap.bundle.min.js"></script>

<script src="../../administrator/admin_view/assets/plugins/select2/js/select2.min.js"></script>

<script src="../../administrator/admin_view/assets/js/moment.min.js"></script>
<script src="../../administrator/admin_view/assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="../../administrator/admin_view/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../../administrator/admin_view/assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="../../administrator/admin_view/assets/js/script.js"></script>
<script src="../../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>

<script src="../../administrator/admin_view/assets/js/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>






</body>
</html>


<!-- Modal -->
<div class="modal fade mt-4" id="export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Exportation Setup</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupSelect01">Select Options</label>
          <select class="form-select" id="inputGroupSelect01">
            <option selected>All</option>
            <option value="1">Year</option>
            <option value="2">Month</option>
            <option value="3">Days</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <label class="input-group-text w-25" for="inputGroupSelect01">Select Year</label>
          <input type="date" class="input-group-text w-75">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Export</button>
      </div>
    </div>
  </div>
</div>