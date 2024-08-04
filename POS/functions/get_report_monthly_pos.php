<?php
// Database connection parameters
include('../config/config.php');
include('session.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT YEAR(orders_date) AS order_year, MONTH(orders_date) AS order_month, SUM(orders_subtotal) AS monthly_total
        FROM pos_orders
        GROUP BY YEAR(orders_date), MONTH(orders_date)
        ORDER BY order_year, order_month
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
