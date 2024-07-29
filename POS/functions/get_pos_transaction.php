<?php 

include ('../config/config.php');
include ('../functions/session.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Prepare the SQL query
$sql = "
    SELECT	
        orders_tcode,	
        orders_discount,	
        orders_discount_name,	
        orders_tax,	
        orders_date,	
        orders_final,	
        orders_payment,	
        orders_change,	
        orders_user_id
    FROM
        pos_orders	
    GROUP BY
        orders_tcode,	
        orders_discount,	
        orders_discount_name,	
        orders_tax,	
        orders_date,	
        orders_final,	
        orders_payment,	
        orders_change,	
        orders_user_id
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