<?php
// Database connection parameters
include('connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT prod_id, prod_image, prod_name, prod_currprice, 
        SUM(qty)as qty ,
        SUM(s_amount) as stocks
        FROM `new_tbl_order_items` 
        JOIN product ON product.prod_id = new_tbl_order_items.product_id 
        JOIN stocks ON product.prod_id = stocks.s_prod_id 
        GROUP BY product_id 
        ORDER BY qty DESC 
        LIMIT 12";

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
