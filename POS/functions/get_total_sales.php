<?php
include('../config/config.php');
include('session.php');

// Set the timezone to Asia/Manila
$conn->query("SET time_zone = '+08:00'"); // Manila timezone is UTC+08:00

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize response array
$response = array();

// Query 1
$query1 = "SELECT SUM(total) AS total_sum 
           FROM new_tbl_orders 
           WHERE t_status = 0 
           AND DATE(CONVERT_TZ(order_date, @@session.time_zone, '+08:00')) = CURDATE() 
           AND status = 'Delivered'";
$result1 = $conn->query($query1);

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $response['todayOnlineSum'] = $row['total_sum'];
} else {
    $response['todayOnlineSum'] = 0;
}

// Query 2
$query2 = "SELECT SUM(orders_final) AS total_sum 
           FROM pos_orders 
           WHERE orders_status = 0 
           AND DATE(CONVERT_TZ(orders_date, @@session.time_zone, '+08:00')) = CURDATE()";
$result2 = $conn->query($query2);

if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $response['todayPosSum'] = $row['total_sum'];
} else {
    $response['todayPosSum'] = 0;
}

// Close the connection
$conn->close();

// Set header to return JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
