<?php
// fetchProductPhotos.php

// Database connection (adjust as needed)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u533477241_rdpos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from the AJAX request
$productID = intval($_POST['productID']);

// Fetch product photos from the database
$sql = "SELECT PROD_PHOTOS FROM productphotos WHERE PHOTOS_PROD_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productID);
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to hold the photo URLs
$photos = array();
while ($row = $result->fetch_assoc()) {
    $photos[] = $row['PROD_PHOTOS'];
}

// Close connection
$stmt->close();
$conn->close();

// Return the photos as JSON
echo json_encode($photos);
?>
