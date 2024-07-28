<?php 

include ('../config/config.php');
include ('../functions/session.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Prepare the SQL query
$sql = "
    SELECT order_id	,
    payment_id,
    subtotal,
    vat,
    sf,
    total,
    order_date,
    delivered_date,
    status	 FROM `new_tbl_orders`
    WHERE 
    status = 'Delivered'
";

// Execute the query
$result = $conn->query($sql);

// Initialize an array to hold the results
$data = array();

if ($result->num_rows > 0) {
    // Fetch all rows as an associative array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Encode the data as JSON and output it
echo json_encode($data);

// Close the database connection
$conn->close();
?>