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
   
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<br>
<div class="page-title">
<h4>Purchase list</h4>
</div>
<div class="page-btn">
<a href="stocks.php" class="btn btn-added btn-primary mb-4">
Add stocks
</a>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="table-top">
    
<div class="search-set">



<div class="search-input">
<a class="btn btn-searchset"></a>
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



<div class="card" id="filter_inputs">
<div class="card-body pb-0">


<div class="table-responsive">
<table class="table datanew">
<thead>
<tr>

<th hidden>
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
    $Grandtotal_taxAmount = $row['Grandtotal_taxAmount'];
    $Grandtotal_Discount = $row['Grandtotal_Discount'];

    echo '
    <tr>
    <td hidden>
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
   
    <td>'.number_format($Grandtotal_taxAmount,2).'</td>

     <td>'.number_format($Grandtotal_cost,2).'</td>
    <td>
    <a class="me-3" href="view_purchased_record.php?precord_reference='.$precord_reference.'">
    <img src="../../administrator/admin_view/assets/img/icons/eye.svg" alt="img">
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