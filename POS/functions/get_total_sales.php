<?php
// Include database configuration and session
include('../config/config.php');
include('session.php');

// Initialize response array
$response = array();

// Log the current date being used for CURDATE()
$current_date = date('Y-m-d');
error_log("Current Date: " . $current_date); // Log the current date

// Query 1: Fetch sum of total for online orders delivered today
$query1 = "SELECT SUM(total) AS total_sum 
           FROM `new_tbl_orders` 
           WHERE t_status = 0 
           AND DATE(delivered_date) = CURDATE() 
           AND status = 'Delivered'";

error_log("Query1: " . $query1); // Log the query for debugging

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
           AND DATE(orders_date) = CURDATE()";

error_log("Query2: " . $query2); // Log the query for debugging

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
