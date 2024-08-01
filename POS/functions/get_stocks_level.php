<?php
// Database connection parameters
include('../config/config.php');
include('session.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT prod_name, prod_critical, prod_image, SUM(s_amount) AS total_amount
        FROM stocks
        JOIN product ON product.prod_id = stocks.s_prod_id
        GROUP BY s_prod_id
        ORDER BY total_amount ASC
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
