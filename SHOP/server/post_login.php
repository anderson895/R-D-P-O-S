<?php 
$name = $_POST['username'] ?? '';
$age = $_POST['password'] ?? '';

// Simulate a response
$response = [
    "status" => "success",
    "message" => "POST data received",
    "name" => $name,
    "age" => $age
];

header('Content-Type: application/json');
echo json_encode($response);
?>