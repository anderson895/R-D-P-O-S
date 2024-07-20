<?php
// Include the database connection
include("../.../../../../../connection.php");

// Check if the query parameter is set
if (isset($_POST['query'])) {
    // Sanitize the user input
    $searchQuery = trim($_POST['query']);

    // Perform a search query based on product name using LIKE
    $sql = "SELECT prod_id, prod_name, prod_expirationStatus ,prod_code ,prod_kg ,prod_ml ,prod_g, prod_currprice, prod_image FROM product WHERE prod_name LIKE ? AND prod_status = '0'";

    // Prepare the SQL statement
    $stmt = $connections->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $searchQuery = '%' . $searchQuery . '%'; // Add wildcards to search for partial matches
        $stmt->bind_param('s', $searchQuery);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Fetch the results as an associative array
        $results = $result->fetch_all(MYSQLI_ASSOC);

        // Set Content-Type header
        header('Content-Type: application/json');

        // Return the results as JSON
        echo json_encode($results);

        // Close the statement
        $stmt->close();
    } else {
        // Handle statement preparation error
        echo json_encode(['error' => 'Statement preparation error']);
    }
} else {
    // If the query parameter is not set, return an empty array
    echo json_encode([]);
}
?>
