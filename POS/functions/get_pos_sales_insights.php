<?php
// Database connection parameters
include('../config/config.php');
include('session.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query with aggregation function to sum sales and group by date
$sql = "SELECT DATE(orders_date) AS order_date, SUM(orders_final) AS total_sales 
        FROM pos_orders 
        GROUP BY DATE(orders_date) 
        ORDER BY DATE(orders_date) DESC 
        LIMIT 10";

// Execute query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Initialize arrays for dates and sales
    $dates = array();
    $sales = array();

    // Fetch results and populate arrays
    while ($row = $result->fetch_assoc()) {
        // Convert date format to "MMM dd" (e.g., "Jul 26")
        $date = new DateTime($row['order_date']);
        $formattedDate = $date->format('M d');
        
        $dates[] = $formattedDate;
        $sales[] = $row['total_sales'];
    }
    
    // Prepare data for JSON response
    $data = array(
        'dates' => $dates,
        'sales' => $sales
    );

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Return empty JSON response if no results
    header('Content-Type: application/json');
    echo json_encode(array('dates' => array(), 'sales' => array()));
}

// Close connection
$conn->close();
?>
