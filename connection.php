<?php
$host = "localhost";
$user = "u547077750_rdpos";
$password = "Rdpos2024";
$database = "u547077750_rdpos";

// Create a connection
$connections = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connections) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
