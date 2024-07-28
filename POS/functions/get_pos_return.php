<?php 
include ('../config/config.php');
include ('../functions/session.php');

// Set the content type to JSON
header('Content-Type: application/json');

// Prepare the SQL query
$sql = "
    SELECT	
        rdate,	
        rcode,	
        rreason,	
        rtype
    FROM
        return_pos_table
    WHERE rtransaction = 0
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