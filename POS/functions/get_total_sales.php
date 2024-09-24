<?php
// Include database configuration and session
include('../config/config.php');
include('session.php');

// Set the timezone to Manila for PHP's date functions
date_default_timezone_set('Asia/Manila');

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the session time zone for MySQL
$setTimeZoneQuery = "SET time_zone = '+08:00'";
if (!$conn->query($setTimeZoneQuery)) {
    die("Error setting time zone: " . $conn->error);
}

// Initialize response array
$response = array();

// Query 2: Fetch sum of total for POS orders today
$query2 = "SELECT SUM(orders_final) AS total_sums
           FROM pos_orders 
           WHERE orders_status = 0 
           AND DATE(orders_date) = CURDATE()";

if ($result2 = $conn->query($query2)) {
    if ($row = $result2->fetch_assoc()) {
        $response['todayPosSum'] = $row['total_sums'] !== null ? $row['total_sums'] : 0;
    } else {
        $response['todayPosSum'] = 0; // No rows found
    }
    $result2->free(); // Free result set
} else {
    error_log("Error in query2: " . $conn->error); // Log the error for debugging
    $response['todayPosSum'] = 0;
}

// Close the connection
$conn->close();

// Set the response header to return JSON and output the response
header('Content-Type: application/json');
echo json_encode($response);
?>
