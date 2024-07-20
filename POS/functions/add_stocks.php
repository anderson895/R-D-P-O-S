<?php
// Include the configuration file to establish a database connection
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the product code and stock amount from the POST data
    $prod_id = $_POST["prod_id"];
    $stocks = $_POST["amount"];
    $date = $_POST["date"];

    // Create a prepared statement to insert data into the stocks table
    $stmt = $conn->prepare("INSERT INTO stocks (s_created, s_expiration, s_prod_id, s_amount, s_amount_number) VALUES ( NOW(), ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("siii", $date,$prod_id, $stocks, $stocks);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Successfully Added");</script>';
        echo '<script>window.location.href = "../pages/inventory";</script>';
    } else {
        echo '<script>alert("Error: Stock data insertion failed.");</script>';
    }
    
    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
