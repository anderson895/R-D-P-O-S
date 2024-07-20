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
<title>Product list</title>


<link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/alertify/alertify.min.css">
<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<!-- <div id="global-loader">
<div class="whirly-loader"> </div>
</div> -->

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
<!-- <h4>Stock List</h4>
<h6>View/Search Products</h6>
</div>
<div class="page-btn">
<a href="stock_in.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New stock</a>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="table-top">
<div class="search-set">
    



<div class="search-input">
<input class="form-control" type="text" id="searchInput" placeholder="Search...">

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
</div> -->
 <?php // include "stock_in/view/filter.php"; ?>
<?php // include "stock_in/view/table.php"; ?> 
<?php include "stock_in/view/table_not_realtime.php";?>
<?php include "stock_in/view/modal.php";?>
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

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
<script src="assets/plugins/alertify/alertify.min.js"></script>

<script src="stock_in/javascript/validationForm.js"></script>
<script src="stock_in/javascript/viewTogler.js"></script>



</body>
</html>