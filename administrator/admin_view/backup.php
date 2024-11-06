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
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin</title>

    <link rel="stylesheet" href="../../POS/assets/css/dashboards_and_analytics.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">

    <link rel="stylesheet" href="assets/plugins/scrollbar/scroll.min.css">
    <link rel="stylesheet" href="assets/plugins/alertify/alertify.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
        <div class="header">
            <input hidden type="text" value="<?=$acc_id?>" id="acc_id">
            <input hidden type="text" value="<?=$fullname?>" id="fullname">
            <input hidden type="text" value="<?=$acc_type?>" id="acc_type">
            <input hidden type="text" value="<?=$db_system_contact?>" id="system_contact">
            <input hidden type="text" value="<?=$db_system_name?>" id="system_name">

            <?php include "topBar/header.php"; ?>

            <ul class="nav user-menu">
                <?php include "topBar/navMenu.php"; ?>
                <?php include "topBar/notification.php"; ?>
                <?php include "topBar/profile.php"; ?>
            </ul>

            <?php include "topBar/mobilUserMenu.php"; ?>
        </div>

        <?php include "Section/sidebar.php"; ?>
Lorem ipsum dolor sit, amet consectetur adipisicing elit. Distinctio eius laboriosam totam odio consequatur atque unde eveniet nostrum voluptatibus, error sequi ut nesciunt quis at illo temporibus iure ipsa recusandae amet. Molestias aspernatur quaerat aperiam ipsam, totam minus iusto corrupti eligendi voluptatem laboriosam mollitia amet, doloribus odio quisquam reprehenderit commodi? Beatae quam, fuga dicta, deleniti neque totam voluptate ex saepe ratione a alias quia vitae sed molestiae quod perspiciatis eveniet suscipit. Ratione quibusdam rerum consectetur ad nihil perferendis praesentium tempora eos? Nulla ullam earum aliquam placeat quidem, sunt et blanditiis culpa fugit eveniet laboriosam minus cum, odit ipsum dicta quos.
        <!---start-changit--->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button class="btn btn-primary">Download</button>
                </div>
            </div>
        </div>
        <!---end-changit--->
        
    </div>
    
    <!-- Scripts -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/plugins/alertify/alertify.min.js"></script>
</body>
</html>
