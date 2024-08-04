<?php
// Database connection parameters
include('../config/config.php');
include('session.php');

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('error' => "Connection failed: " . $conn->connect_error)));
}

// SQL query
$sql = "SELECT DATE(order_date) AS order_date, SUM(total) AS daily_total
        FROM new_tbl_orders
        GROUP BY DATE(order_date)
        ORDER BY order_date";

// Execute query
$result = $conn->query($sql);

// Check if query was successful
if ($result) {
    // Fetch results into an associative array
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Return JSON error response if query fails
    header('Content-Type: application/json');
    echo json_encode(array('error' => "Query failed: " . $conn->error));
}

// Close connection
$conn->close();
?>
