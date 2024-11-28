<?php
include("../.../../../../../connection.php");

$invoice_no = $_POST["invoice_no"];

// Fetch data from the database
$view_query = mysqli_query($connections, "SELECT *
FROM stocks s
LEFT JOIN product p ON s.s_prod_id = p.prod_id
WHERE s.s_invoice = '$invoice_no' AND s_status='1';");

$data = array();

while ($row = mysqli_fetch_assoc($view_query)) {
    // Process and add data to the array as needed
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
?>
