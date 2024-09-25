<?php
include "backend/back_navbar.php";
include "php/session_dir.php";


$target_id=$_GET["target_id"];

$view_query = mysqli_query($connections, "SELECT *
FROM account
LEFT JOIN user_address
ON account.acc_code = user_address.user_acc_code
WHERE account.acc_type = 'customer' AND account.acc_display_status = '0' AND user_address.user_add_Default_status='1' AND account.acc_id='$target_id';");

if ($row = mysqli_fetch_assoc($view_query)) {
    $get_acc_id = $row["acc_id"];
    $get_acc_code = $row["acc_code"];
    $get_acc_fname = $row["acc_fname"];
    $get_acc_lname = $row["acc_lname"];
    $get_acc_username = $row["acc_username"];
    $get_acc_contact = $row["acc_contact"];
    $get_acc_type = $row["acc_type"];
    $get_acc_status = $row["acc_status"];
    $get_acc_email = $row["acc_email"];
    $get_emp_image = $row["emp_image"];
    $get_acc_cover_img = $row["acc_cover_img"];
    $get_acc_birthday = $row["acc_birthday"];
    $get_user_complete_address = $row["user_complete_address"];



    date_default_timezone_set('Asia/Manila'); // Set the timezone to Philippines
    // Assuming $get_db_acc_birthday is a variable that contains the user's birthday
    $birthday = new DateTime($get_acc_birthday);
    $today = new DateTime();
    $today->setTimezone(new DateTimeZone('Asia/Manila')); // Set timezone to Philippines
    $age = $today->diff($birthday)->y; // Calculate the age




    $get_email_parts = explode('@', $get_acc_email);
    $get_username = $get_email_parts[0];
    $get_domain = $get_email_parts[1];
    $get_username_length = strlen($get_username);
    $get_hidden_username = substr_replace($get_username, '******', 1, $get_username_length - 2);
    $get_masked_email = $get_hidden_username . '@' . $get_domain;

    $get_full_name = ucfirst($get_acc_fname) . " " . $get_acc_lname;
}

// Now, you have the values from the first row without the need for a loop.

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
<title>Profile</title>


<link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">

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

    <?php  include "profile_customer/view/profile_customerform.php"; ?>


<script src='profile/controller/profileValidation.js'></script>
<script src='profile/javascript/email_validation.js'></script>
<script src='profile/javascript/registerLen_validation.js'></script>

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
</body>
</html>