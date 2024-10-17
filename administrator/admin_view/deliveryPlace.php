
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
<title>Places</title>


<link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">


<link rel="stylesheet" href="assets/plugins/scrollbar/scroll.min.css">

<link rel="stylesheet" href="assets/plugins/alertify/alertify.min.css">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

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

    <?php include "topBar/mobilUserMenu.php"; ?>
</div>
    <?php  include "Section/sidebar.php"; ?>


<div class="page-wrapper">
    <div class="content">
            <div class="page-header">
                <div class="page-title">
                <h4>List of Address</h4>
                <h6>View/Search Delivery address</h6>
                </div>
            <div class="page-btn">
        <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addDeliveryAddress">
        <img src="assets/img/icons/plus.svg" alt="img" class="me-2" >Add address
        </a>
    </div>
</div>




<?php 


include "delivery_place/view/filter.php";
include "delivery_place/view/delivery_placeForm.php";







include "delivery_place/view/Modal.php";
?>


</div>
</div>
</div>



<script>
    console.log(addressData); // This will display the data in the browser's console

</script>



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



<script src="assets/plugins/alertify/alertify.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="delivery_place/javascript/address_api.js"></script>
<script src="delivery_place/javascript/insertAddress.js"></script>


<script src="delivery_place/javascript/ajaxCheckStatus.js"></script>

<script src="delivery_place/javascript/searchAddressApiForAdd.js"></script>





</body>
</html>