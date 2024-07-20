<?php
include '../connection.php';

$searchTerm = $_GET['term'];
$query = "SELECT prod_name FROM product WHERE prod_status = 0 AND prod_name LIKE '%$searchTerm%'";
$result = $conn->query($query);

$suggestions = array();
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['prod_name'];
}

$conn->close();
echo json_encode($suggestions);
?>
