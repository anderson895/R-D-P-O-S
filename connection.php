<?php
$host = "localhost";
$user = "u293217990_rdpos";
$password = "Rdpos2025";
$database = "u293217990_rdpos";

// Create a connection
$connections = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connections) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
