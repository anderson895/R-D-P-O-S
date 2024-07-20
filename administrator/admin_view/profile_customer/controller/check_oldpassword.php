<?php
// Connect to your database
include("../../../../connection.php");
 // Connect to your database<?php

if (!$connections) {
    die("Database connection failed: " . mysqli_connect_error());
}
$account_id=$_GET["account_id"];
$Oldpassword = $_GET['Oldpassword'];


$query = "SELECT COUNT(*) FROM account WHERE acc_password = '$Oldpassword' AND acc_id = $account_id";
$result = mysqli_query($connections, $query);

if ($result) {
    $count = mysqli_fetch_row($result)[0];
    if ($count > 0) {
        echo '';
    } else {
        echo 'Enter Correct Password';
    }
} else {
    echo 'Database query error';
}

// Close the database connection
mysqli_close($connections);
?>
