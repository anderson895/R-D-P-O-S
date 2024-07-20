<?php 
include ('../config/config.php');

$query = "SELECT SUM(subtotal) as total_subtotal FROM pos_cart";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $totalSubtotal = $row['total_subtotal'];
}

// Return the total subtotal as a JSON response
$response = array('total_subtotal' => $totalSubtotal);
header('Content-Type: application/json');
echo json_encode($response);
?>
