<?php
// Retrieve the JSON data from the request
$data = json_decode(file_get_contents("php://input"));

// Process the order data as needed
$orderHTML = $data->orderHTML;
// Process other data if needed

// You can send a response back if required
$response = ["message" => "Order data received successfully"];
echo json_encode($response);
?>
