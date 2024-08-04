<?php
// Database connection parameters
include('../config/config.php');
include('session.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT DATE(order_date), SUM(total) AS daily_total
        FROM new_tbl_orders
        GROUP BY DATE(order_date)
        ORDER BY order_date;
        ";

// Execute query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch results into an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Return empty JSON response if no results
    header('Content-Type: application/json');
    echo json_encode(array());
}

// Close connection
$conn->close();
?>
