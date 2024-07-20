<?php 
include ('../config/config.php');

$product_id = 140;

// First, get the minimum s_created value for the given s_prod_id
$min_created_query = "SELECT MIN(s_created) FROM stocks WHERE s_prod_id = $product_id";
$min_created_result = $conn->query($min_created_query);
$min_created = $min_created_result->fetch_row()[0];

// Update the record with the minimum s_created value
$update_query = "UPDATE stocks SET s_amount = s_amount - 6 WHERE s_prod_id = $product_id AND s_created = '$min_created'";
if ($conn->query($update_query) === TRUE) {
    echo "Update successful!";
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();

?>

