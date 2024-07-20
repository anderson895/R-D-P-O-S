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
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Admin</title>

<link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">

<link rel="stylesheet" href="assets/plugins/alertify/alertify.min.css">

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


<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>PURCHASE LIST</h4>
<h6>Manage your purchases</h6>
</div>
<div class="page-btn">
<a href="addpurchase.php" class="btn btn-added">
<img src="assets/img/icons/plus.svg" alt="img">Add New Purchases
</a>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="table-top">
<div class="search-set">
<div class="search-path">
<a class="btn btn-filter" id="filter_search">
<img src="assets/img/icons/filter.svg" alt="img">
<span><img src="assets/img/icons/closes.svg" alt="img"></span>
</a>
</div>
<div class="search-input">
<a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
</div>
</div>
<div class="wordset">
<ul>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
</li>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
</li>
<li>
<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
</li>
</ul>
</div>
</div>

<div class="card" id="filter_inputs">
<div class="card-body pb-0">
<div class="row">
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<input type="text" class="datetimepicker cal-icon" placeholder="Choose Date">
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<input type="text" placeholder="Enter Reference">
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Choose Supplier</option>
<option>Supplier</option>
</select>
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Choose Status</option>
<option>Inprogress</option>
</select>
</div>
</div>
<div class="col-lg col-sm-6 col-12">
<div class="form-group">
<select class="select">
<option>Choose Payment Status</option>
<option>Payment Status</option>
</select>
</div>
</div>
<div class="col-lg-1 col-sm-6 col-12">
<div class="form-group">
<a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
</div>
</div>
</div>
</div>
</div>

<div class="table-responsive">
<table class="table datanew">
<thead>
<tr>
<th>
<label class="checkboxs">
<input type="checkbox" id="select-all">
<span class="checkmarks"></span>
</label>
</th>
<th>Supplier Name</th>
<th>Reference</th>
<th>Date</th>
<th>Total discount</th>
<th>Total tax</th>
<th>Grand Total</th>

<th>Action</th>
</tr>
</thead>
<tbody>

<?php 
$view_query = mysqli_query($connections,"SELECT *,
purchased_record.precord_reference,
SUM(purchased_record.precord_Total_Cost) AS Grandtotal_cost,
SUM(purchased_record.precord_Tax) AS Grandpurchased_Tax,
SUM(purchased_record.precord_Tax_Amount) AS Grandtotal_taxAmount,
SUM(purchased_record.precord_discount) AS Grandtotal_Discount
FROM purchased_record
LEFT JOIN product ON purchased_record.precord_prod_id = product.prod_id
LEFT JOIN supplier ON purchased_record.precord_sup_id = supplier.spl_id
where purchased_status='0'
GROUP BY purchased_record.precord_reference
ORDER BY `precord_id` DESC


;
"); 

while($row = mysqli_fetch_assoc($view_query)){ 
    $precord_id = $row["precord_id"];
    $precord_reference = $row["precord_reference"];
    $spl_name = $row["spl_name"];
    $prod_name = $row["prod_name"];
   
    $originalDate = $row['precord_date'];
    $timestamp = strtotime($originalDate); // Convert the date to a Unix timestamp
    $formattedDate = date("d F Y h:i A", $timestamp); // Adds time in 12-hour format with AM/PM
    

    $Grandtotal_cost = $row['Grandtotal_cost'];
    $Grandpurchased_Tax = $row['Grandtotal_taxAmount'];
    $Grandtotal_Discount = $row['Grandtotal_Discount'];

    echo '
    <tr>
    <td>
    <label class="checkboxs">
    <input type="checkbox">
    <span class="checkmarks"></span>
    </label>
    </td>
    <td class="text-bolds">'.$spl_name.'</td>
    <td class="text-bolds">'.$precord_reference.'</td>
    <td>'.$formattedDate.'</td>
    <td>'.number_format($Grandtotal_Discount,2).'</td>
    ';
    
   
    echo '
   
    <td>'.number_format($Grandpurchased_Tax,2).'</td>

     <td>'.number_format($Grandtotal_cost,2).'</td>
    <td>
    <a class="me-3" href="view_purchased_record.php?precord_reference='.$precord_reference.'">
    <img src="assets/img/icons/eye.svg" alt="img">
    </a>
    <a class="me-3 deleteConfirmation" data-record_id='.$precord_id.' data-acc_id='.$db_acc_id.'>
    <img src="assets/img/icons/delete.svg" alt="img">
    </a>
    </td>
    </tr>
    ';
}
?>



</tbody>
</table>
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

<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/plugins/alertify/alertify.min.js"></script>

<script src="assets/js/script.js"></script>

<script src="managestocks/javascript/toglerDeleteConfirmation.js"></script>
</body>
</html>