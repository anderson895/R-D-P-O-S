<?php
// Include the database configuration file
include('../config/config.php');

// Ensure that $conn (the database connection) is used
$get_record = $conn->query("SELECT * FROM maintinance");

if ($get_record) {
    // Fetch the result as an associative array
    $row = $get_record->fetch_assoc();

    // Assign the fetched values to variables
    $db_system_name = $row["system_name"];
    $db_system_logo = $row["system_logo"];
    $db_system_banner = $row["system_banner"];
    $db_system_tax = $row["system_tax"];
    $db_system_address = $row["system_address"];
    $db_system_content = $row["system_content"];
} else {
    // Handle query error
    die('Query failed: ' . $conn->error);
}

// Close the connection after use
$conn->close();
?>
