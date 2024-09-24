<?php
// Include database configuration and session
include('../config/config.php');
include('session.php');

// Set the timezone to Manila for PHP date functions
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

// Query 1: Fetch sum of total for online orders delivered today
$query1 = "SELECT SUM(total) AS total_sum 
           FROM `new_tbl_orders` 
           WHERE t_status = 0 
           AND DATE(order_date) = CURDATE() 
           AND status = 'Delivered'";

$result1 = $conn->query($query1);
if ($result1) {
    $row = $result1->fetch_assoc();
    $response['todayOnlineSum'] = $row['total_sum'] ?? 0; // Use null coalescing to handle null results
} else {
    $response['todayOnlineSum'] = 0;
    error_log("Error in query1: " . $conn->error); // Log the error for debugging
}

// Query 2: Fetch sum of total for POS orders today
$query2 = "SELECT SUM(orders_final) AS total_sum 
           FROM pos_orders 
           WHERE orders_status = 0 
           AND DATE(CONVERT_TZ(orders_date, @@session.time_zone, '+08:00')) = CURDATE()";

$result2 = $conn->query($query2);
if ($result2) {
    $row = $result2->fetch_assoc();
    $response['todayPosSum'] = $row['total_sum']; // Use null coalescing to handle null results
} else {
    $response['todayPosSum'] = 0;
    error_log("Error in query2: " . $conn->error); // Log the error for debugging
}

// Close the connection
$conn->close();

// Set the response header to return JSON and output the response
header('Content-Type: application/json');
echo json_encode($response);
?>
