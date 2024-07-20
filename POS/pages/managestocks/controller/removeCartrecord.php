<?php
include("../../../../connection.php");

// Check if there's an error in the connection
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the prodcart ID from the POST request
    $prodcart = $_POST['prodcart'];

    // Create an SQL query to delete the record
    $sql = "DELETE FROM purchasedcart WHERE purchase_id = ?";

    // Use a prepared statement to prevent SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("i", $prodcart);

        if ($stmt->execute()) {
            // Successful deletion
            echo "Record deleted successfully.";
        } else {
            // Error in deletion
            echo "Error deleting the record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error in prepared statement
        echo "Error preparing statement: " . $connections->error;
    }
}

// Close the database connection
$connections->close();
?>
