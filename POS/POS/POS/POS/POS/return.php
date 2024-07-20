<?php
include '../connection.php';
session_start();

if(!isset($_SESSION['acc_id'])) {
    header("Location: login.php");
    exit();
}

// cashier id
$acc_id= $_SESSION['acc_id'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/transaction.css">
    <link rel="icon" href="../assets/images/logos.png" type="image/x-icon">
    <title>RDPOS-Transactions</title>
</head>
<body>
<?php include 'navigation.php'?>
    <div class="main-screen">
        <div class="transaction">
            <div class="container" style="margin-top: 20px;">
                <h1 class="color-gray">Return Item List</h1>
            </div>
            <div class="container">
                <p style="margin-left: 25px; margin-top: 10px; color: gray;">Soon to update</p>
            </div>

            
        </div>
    </div>
</body>
</html>