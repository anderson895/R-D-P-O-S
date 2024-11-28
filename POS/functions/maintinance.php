<?php
include('../config/config.php');

// Check if the connection was successful
if (!$connections) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Query to fetch data from the 'maintinance' table
$get_record = mysqli_query($connections, "SELECT * FROM maintinance");

if (!$get_record) {
    die('Query failed: ' . mysqli_error($connections));
}

// Fetch the results as an associative array
$row = mysqli_fetch_assoc($get_record);

// Store the values into variables
$db_system_name = $row["system_name"];
$db_system_logo = $row["system_logo"];
$db_system_banner = $row["system_banner"];
$db_system_tax = $row["system_tax"];
$db_system_address = $row["system_address"];
$db_system_content = $row["system_content"];

// Close the connection when done
mysqli_close($connections);
?>
