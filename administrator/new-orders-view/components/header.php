<?php
session_start();
include('backend/class.php');
$db = new global_class();
if (isset($_SESSION['acc_id'])) {
    $checkUser = $db->checkUser($_SESSION['acc_id']);
    if ($checkUser->num_rows > 0) {
        $user = $checkUser->fetch_assoc();
        if ($user['acc_type'] != 'administrator') {
            header('Location: backend/logout.php');
            exit;
        }
    } else {
        header('Location: backend/logout.php');
        exit;
    }
} else {
    header('Location: backend/logout.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="shortcut icon" href="../../assets/logos.png" type="image/x-icon">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">

    
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/styles.css">
    

    <link rel="stylesheet" href="../admin_view/assets/plugins/alertify/alertify.min.css">

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
</head>


<body>
    <div class="alert alert-success"></div>
    <div class="alert alert-danger"></div>
    <nav class="d-flex justify-content-between align-items-center p-3 pt-0 pb-0 top-nav" style="background-color:rgb(131, 0, 0);">
    <a href="orders.php">
        <img src="../../upload_system/logo.png">
    </a>
    <?= ($user['acc_type'] == 'administrator') ? '<a href="../admin_view/index.php" class="text-light" style="text-decoration: none; margin-right: 20px">Dashboard</a>' : '' ?>
        
    <div>
       
        <!-- Profile Button with Dropdown -->
        <div class="dropdown">
            <button id="btnProfile" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?= ($user['emp_image'] != '') ? '<img src="../../upload_img/' . $user['emp_image'] . '" class="rounded-circle" style="width: 40px; height: 40px;">' :  '<i class="bi bi-person-fill"></i>' ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btnProfile">
                <li><a class="dropdown-item" onclick="window.location.href='generalsettings.php?account_id=<?=$db_acc_id?>';"><i class="me-2" data-feather="settings"></i>Settings</a></li>
                <li><a class="dropdown-item" onclick="window.location.href='privacysettings.php?account_id=<?=$db_acc_id?>';"><i class="me-2" data-feather="lock"></i>Privacy</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>






    
<!-- <li class="nav-item dropdown has-arrow main-drop">
<a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
<span class="user-img"><img src="../../upload_img/<?= $db_emp_image?>" alt="">
<span class="status online"></span></span>
</a>
<div class="dropdown-menu menu-drop-user">
<div class="profilename" >
<div class="profileset" onclick="window.location.href='profile.php?account_id=<?=$db_acc_id?>';">
<span class="user-img"><img src="../../upload_img/<?= $db_emp_image?>" alt="">
<span class="status online"></span></span>
<div class="profilesets">
<h6><?= $fullname?></h6>
<h5><?= $db_acc_type?></h5>
</div>

</div>
<hr class="m-0">
<a class="dropdown-item" onclick="window.location.href='generalsettings.php?account_id=<?=$db_acc_id?>';"><i class="me-2" data-feather="settings"></i>Settings</a>
<a class="dropdown-item" onclick="window.location.href='privacysettings.php?account_id=<?=$db_acc_id?>';"><i class="me-2" data-feather="lock"></i>Privacy</a>

<hr class="m-0">
<a class="dropdown-item logout pb-0" href="backend/logout.php"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
</div>
</div>
</li> -->