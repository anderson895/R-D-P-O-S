<?php
session_start();
include('backend/class.php');
$db = new global_class();
if (isset($_SESSION['acc_id'])) {
    $checkUser = $db->checkUser($_SESSION['acc_id']);
    if ($checkUser->num_rows > 0) {
        $user = $checkUser->fetch_assoc();
    } else {
        header('Location: ../Main/login.php');
        exit;
    }
} else {
    header('Location: ../Main/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDPOS</title>
    <link rel="shortcut icon" href="../assets/logos.png" type="image/x-icon">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/orders.css">
    <link rel="stylesheet" href="css/view-order.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
</head>

<div class="alert alert-danger"></div>
<div class="alert alert-success"></div>

<body class="">
    <nav class="maroon d-flex justify-content-between align-items-center p-3 pt-2 pb-2 top-nav">
        <div class="toggle-logo-container d-flex">
            <button id="btnToggleSideBar" class="btn-toggle-side-bar">
                <i class="bi bi-list"></i>
            </button>
            <a class="logo-a" href="index.php">
                <img src="../assets/logos.png">
            </a>
        </div>
        <div class="">
            <button id="btnProfileDropdown" class="btn-profile">
                <?= ($user['emp_image'] != '') ? '<img src="assets/profile-pictures/' . $user['emp_image'] . '">' :  '<i class="bi bi-person-fill"></i>' ?>
            </button>
            <div class="dropdown-menu" id="dropDownItems">
              <a href="profile.php" class="dropdown-item" href="#"><i class="bi bi-person-check"></i> Edit Profile</a>
              <a href="backend/logout.php"class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </nav>
    <aside class="side-nav">
        <ul class="list-group">
            <li><a href="index.php" class="nav-all-products"><i class="bi bi-shop"></i> All Products</a></li>
            <li><a href="cart.php" class="nav-cart"><i class="bi bi-cart-check"></i> Cart <span class="badge bg-danger mx-2" id="cart-count"></span></a></li>
            <li><a href="orders.php?page=Pending" class="nav-my-orders"><i class="bi bi-newspaper"></i> My Orders</a></li>
            <li><a href="index.php" class="nav-message"><i class="bi bi-chat"></i> Message</a></li>
            <li><a href="index.php" class="nav-notification"><i class="bi bi-bell"></i> Notification</a></li>
        </ul>
    </aside>
    <main class="">
        <div class="container p-3">