<?php
// Database credentials
$hostname = 'localhost';      // Change this to your database hostname
$username = 'u547077750_rdpos';   // Change this to your database username
$password = 'Rdpos2024';   // Change this to your database password
$database = 'u547077750_rdpos';   // Change this to your database name

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Your queries and logic here

// Close the connection when done
$conn->close();
?>
