<?php 
include('../config/config.php');
include('session.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statements
$sql_cashier = "SELECT COUNT(acc_type) AS count FROM `account` WHERE acc_type = 'cashier' AND acc_display_status ='0'";
$sql_supplier = "SELECT COUNT(spl_id) AS count FROM `supplier` WHERE spl_status = 0";
$sql_customer = "SELECT COUNT(acc_type) AS count FROM `account`
LEFT JOIN user_address
ON account.acc_code = user_address.user_acc_code
 WHERE acc_type = 'customer' 
 AND acc_display_status ='0'
  AND (user_address.user_add_Default_status = '1' OR user_address.user_add_Default_status IS NULL)
 ";
$sql_delivery = "SELECT COUNT(acc_type) AS count FROM `account` WHERE acc_type = 'deliveryStaff' AND acc_display_status ='0'";

// Execute the queries and fetch the results
$result_cashier = $conn->query($sql_cashier);
$result_supplier = $conn->query($sql_supplier); // Fixed variable name
$result_customer = $conn->query($sql_customer);
$result_delivery = $conn->query($sql_delivery);

$response = array();

if ($result_cashier && $result_cashier->num_rows > 0) {
    $row = $result_cashier->fetch_assoc();
    $response['cashier'] = $row['count'];
}

if ($result_supplier && $result_supplier->num_rows > 0) { // Fixed variable name
    $row = $result_supplier->fetch_assoc(); // Fixed variable name
    $response['supplier'] = $row['count']; // Correct key
}

if ($result_customer && $result_customer->num_rows > 0) {
    $row = $result_customer->fetch_assoc();
    $response['customer'] = $row['count'];
}

if ($result_delivery && $result_delivery->num_rows > 0) {
    $row = $result_delivery->fetch_assoc();
    $response['deliveryStaff'] = $row['count'];
}

// Close the connection
$conn->close();

// Set the content type to JSON
header('Content-Type: application/json');

// Return the response as a JSON object
echo json_encode($response);
?>
