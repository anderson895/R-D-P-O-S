<?php
// Include database configuration and session
include('../config/config.php');
include('session.php');


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
           AND DATE(order_date, @@session.time_zone, '+08:00')) = CURDATE() 
           AND status = 'Delivered'";

if ($result1 = $conn->query($query1)) {
    if ($row = $result1->fetch_assoc()) {
        $response['todayOnlineSum'] = $row['total_sum'] !== null ? $row['total_sum'] : 0;
    } else {
        $response['todayOnlineSum'] = 0; // No rows found
    }
    $result1->free(); // Free result set
} else {
    error_log("Error in query1: " . $conn->error); // Log the error for debugging
    $response['todayOnlineSum'] = 0;
}

// Query 2: Fetch sum of total for POS orders today
$query2 = "SELECT SUM(orders_final) AS total_sum
           FROM pos_orders 
           WHERE orders_status = 0 
           AND DATE(orders_date) = CURDATE()
           ";

if ($result2 = $conn->query($query2)) {
    if ($row = $result2->fetch_assoc()) {

       
        $response['todayPosSum'] = $row['total_sum'] !== null ? $row['total_sum'] : 0;
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
