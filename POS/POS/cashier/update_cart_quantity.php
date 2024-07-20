<?php
// update_cart_quantity.php

// Retrieve the cart ID and new quantity from the AJAX request
$cartId = $_POST['cartId'];
$quantity = $_POST['quantity'];

// Perform necessary database operations to update the quantity in the pos_cart table
// Replace the database credentials with your own
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rdpos";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the cart_prodQty in the pos_cart table
$sql = "UPDATE pos_cart SET cart_prodQty = '$quantity' WHERE pos_cart_id = '$cartId'";

if ($conn->query($sql) === TRUE) {
    // Return a success response (optional)
    echo "Quantity updated successfully";
} else {
    // Return an error response (optional)
    echo "Error updating quantity: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
