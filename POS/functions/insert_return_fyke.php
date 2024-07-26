<?php
include('../config/config.php');
include('session.php');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize POST data
$rcode = isset($_POST['rcode']) ? $conn->real_escape_string($_POST['rcode']) : '';
$rreason = isset($_POST['rreason']) ? $conn->real_escape_string($_POST['rreason']) : '';
$rtype = isset($_POST['rtype']) ? $conn->real_escape_string($_POST['rtype']) : '';
$selectedItems = isset($_POST['selectedItems']) ? $conn->real_escape_string(json_encode($_POST['selectedItems'])) : '';

// Prepare and execute the SQL statements
$insertSql = "INSERT INTO return_pos_table (rdate, rcode, rreason, rtype, selected_items)
              VALUES (NOW(), '$rcode', '$rreason', '$rtype', '$selectedItems')";

$updateSql = "UPDATE pos_orders 
              SET orders_status = '1' 
              WHERE orders_tcode = '$rcode'";

try {
    // Begin a transaction
    $conn->begin_transaction();

    // Insert into return_pos_table
    if ($conn->query($insertSql) !== TRUE) {
        throw new Exception("Insert Error: " . $conn->error);
    }

    // Update pos_orders
    if ($conn->query($updateSql) !== TRUE) {
        throw new Exception("Update Error: " . $conn->error);
    }

    // Commit the transaction
    $conn->commit();
    echo "New record created and orders status updated successfully";
} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo $e->getMessage();
}

// Close the connection
$conn->close();
?>
