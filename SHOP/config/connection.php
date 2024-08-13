<?php
// // Database credentials
$hostname = 'localhost';      // Change this to your database hostname
$username = 'root';   // Change this to your database username
$password = '';   // Change this to your database password
$database = 'u533477241_rdpos';   // Change this to your database name


// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

?>