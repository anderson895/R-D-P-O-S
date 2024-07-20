<?php
session_start();
include('backend/class.php');
$db = new global_class();
if (isset($_SESSION['acc_id'])) {
    $checkUser = $db->checkUser($_SESSION['acc_id']);
    if ($checkUser->num_rows > 0) {
        $user = $checkUser->fetch_assoc();
        if ($user['acc_type'] != 'deliveryStaff') {
            header('Location: ../Main/login.php');
            exit;
        }
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
    <title>RDPOS | Rider</title>
    <link rel="shortcut icon" href="../assets/logos.png" type="image/x-icon">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
</head>

<div class="alert alert-danger"></div>
<div class="alert alert-success"></div>

<body class="">
    <nav class="bg-dark d-flex justify-content-between align-items-center p-3 pt-2 pb-2 top-nav">
        <div class="toggle-logo-container d-flex">
            <button id="btnToggleSideBar" class="btn-toggle-side-bar">
                <i class="bi bi-list"></i>
            </button>
            <a class="logo-a" href="index.php">
                <img src="../assets/logos.png">
            </a>
        </div>
        <div>
            <button id="btnProfile" class="btn-profile">
                <?= ($user['emp_image'] != '') ? '<img src="../upload_img/' . $user['emp_image'] . '">' :  '<i class="bi bi-person-fill"></i>' ?>
            </button>
            <a href="backend/logout.php" class="btn btn-primary">Logout</a>
        </div>
    </nav>
    <main class="container pt-4">