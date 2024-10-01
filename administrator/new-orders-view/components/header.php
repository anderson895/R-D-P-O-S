<?php
session_start();
include('backend/class.php');
$db = new global_class();
if (isset($_SESSION['acc_id'])) {
    $maintinance = $db->getSystemMaintinance();
    $system = $maintinance->fetch_assoc();


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
    <a href="../admin_view/index.php">
        <img src="../../upload_system/<?=$system['system_logo']?>">
    </a>
    <?= ($user['acc_type'] == 'administrator') ? '<a href="../admin_view/index.php" class="text-light" style="text-decoration: none; margin-right: 20px">Dashboard</a>' : '' ?>
        
    <div>
        <!-- Profile Button with Dropdown -->
        <div class="dropdown">
            <button id="btnProfile" class="btn btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                <?= ($user['emp_image'] != '') ? '<img src="../../upload_img/' . $user['emp_image'] . '" class="rounded-circle" style="width: 40px; height: 40px;">' : '<i class="bi bi-person-fill"></i>' ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="btnProfile">
                <li><a class="dropdown-item" href='../admin_view/generalsettings.php?account_id=<?=$_SESSION['acc_id']?>'>Settings</a></li>
                <li><a class="dropdown-item" href='../admin_view/privacysettings.php?account_id=<?=$_SESSION['acc_id']?>'>Privacy</a></li>
                <li><a class="dropdown-item" href="../admin_view/backend/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>



