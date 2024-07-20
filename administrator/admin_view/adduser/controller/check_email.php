<?php
// Connect to your database
include("../../../../connection.php");
 // Connect to your database<?php

if (!$connections) {
    die("Database connection failed: " . mysqli_connect_error());
}
//$account_id=$_GET["account_id"];
$email = $_GET['email'];


$query = "SELECT COUNT(*) FROM account WHERE acc_email = '$email'";
$result = mysqli_query($connections, $query);

if ($result) {
    $count = mysqli_fetch_row($result)[0];
    if ($count > 0) {
        echo 'Email already exists';
    } else {
        echo '';
    }
} else {
    echo 'Database query error';
}

// Close the database connection
mysqli_close($connections);
?>
