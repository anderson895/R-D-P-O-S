<?php
include "backend/back_navbar.php";
include "php/session_dir.php";


$account_id=$_GET["account_id"];


$get_record_account = mysqli_query ($connections,"SELECT * FROM account where acc_id='$account_id'");
		$row_account = mysqli_fetch_assoc($get_record_account);
		 $get_db_acc_code_target = $row_account["acc_code"];
         $get_db_acc_created = $row_account["acc_created"];
         $get_db_acc_username = $row_account["acc_username"];
         $get_db_acc_fname = $row_account["acc_fname"];
         $get_db_acc_lname = $row_account["acc_lname"];
         $get_db_acc_birthday = $row_account["acc_birthday"];
         $get_db_acc_type = $row_account["acc_type"];
         $get_db_acc_status = $row_account["acc_status"];
         $get_db_acc_email = $row_account["acc_email"];
         $get_db_acc_contact = $row_account["acc_contact"];
         $get_db_emp_image = $row_account["emp_image"];
         $get_db_acc_cover_img = $row_account["acc_cover_img"];
         $get_db_acc_lastEdit = $row_account["acc_lastEdit"];


         $get_fullname=ucfirst($get_db_acc_fname)." ".$get_db_acc_lname;


        
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
<title>Privacy Settings</title>


<link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">


<link rel="stylesheet" href="assets/plugins/alertify/alertify.min.css">


<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">


<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="assets/plugins/icons/ionic/ionicons.css">
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

    <?php  include "privacySettings/view/privacySetting_form.php"; ?>


<script src='privacySettings/javascript/profileValidation.js'></script>

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
</body>
</html>