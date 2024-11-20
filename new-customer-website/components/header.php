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

$maintinance = $db->getSystemMaintinance();
$system = $maintinance->fetch_assoc();
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
    <link rel="stylesheet" href="css/zoom.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
   
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
            <a class="logo-a text-decoration-none" href="index.php">
                    <img src="../../upload_system/<?=$system['system_logo']?>" alt="System Logo" style="height: 50px;"> <!-- Adjust height as needed -->
                    <span class="fs-3 fw-bold text-light"><?=$system['system_name']?></span>
            </a>
        </div>
        <div class="">
            <button id="btnProfileDropdown" class="btn-profile">
                <?= ($user['emp_image'] != '') ? '<img src="../upload_img/' . $user['emp_image'] . '" class="img-fluid rounded-circle" style="max-width: 40px;">' :  '<i class="bi bi-person-fill"></i>' ?>
            </button>
            <div class="dropdown-menu" id="dropDownItems">
              <a href="profile.php" class="dropdown-item" href="#"><i class="bi bi-person-check"></i> Profile</a>
              <a href="backend/logout.php"class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </nav>


    
    <!-- <aside class="side-nav">
        <ul class="list-group">
            <li><a href="index.php" class="nav-all-products"><i class="bi bi-shop"></i> All Products</a></li>
            <li><a href="cart.php" class="nav-cart"><i class="bi bi-cart-check"></i> Cart <span class="badge bg-danger mx-2" id="cart-count"></span></a></li>
            <li><a href="orders.php?page=Pending" class="nav-my-orders"><i class="bi bi-newspaper"></i> My Orders</a></li>
            <li><a href="message.php" class="nav-message"><i class="bi bi-chat"></i> Message</a></li>
          
        </ul>
    </aside> -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Brand Logo or Title (optional) -->
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-shop"></i> Shop
        </a>

        <!-- Navbar Links -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-shop"></i> All Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="bi bi-cart-check"></i> Cart 
                        <span class="badge bg-danger mx-2" id="cart-count"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php?page=Pending">
                        <i class="bi bi-newspaper"></i> My Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="message.php">
                        <i class="bi bi-chat"></i> Message
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <main class="">
        <div class="container p-3">