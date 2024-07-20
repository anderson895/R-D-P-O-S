<?php
include("../.../../../../../connection.php");

// Assuming you have a database connection, perform the check
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchProductCode'])) {
    $searchProductCode = $_POST['searchProductCode'];


    // Check the connection
    if ($connections->connect_error) {
        die("Connection failed: " . $connections->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $connections->prepare("SELECT COUNT(*) as count FROM product WHERE prod_code = ?");
    $stmt->bind_param("s", $searchProductCode);
    $stmt->execute();
    
    // Bind the result
    $stmt->bind_result($count);

    // Fetch the result
    $stmt->fetch();

    // Return JSON response indicating whether the product exists
    echo json_encode(['exists' => $count > 0]);

    // Close the statement and connection
    $stmt->close();
    $connections->close();
} else {
    // Invalid request, return an error response
    echo json_encode(['error' => 'Invalid request']);
}
?>
