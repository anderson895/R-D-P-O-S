<?php
include("../.../../../../../connection.php");

$invoice_no = $_POST["invoice_no"];
$filter = isset($_POST['filter']) ? $_POST['filter'] : 'all'; // Default filter is 'all'

// Set the expiration condition based on the filter
if ($filter == 'normal') {
    $expiration_condition = "AND s.s_expiration > NOW()";
} elseif ($filter == 'soon') {
    $expiration_condition = "AND s.s_expiration BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 2 MONTH)";
} elseif ($filter == 'expired') {
    $expiration_condition = "AND s.s_expiration < NOW()";
} else {
    $expiration_condition = ""; // Show all items if 'all' filter is selected
}

// Fetch data from the database with the filter applied
$view_query = mysqli_query($connections, "SELECT *
FROM stocks s
LEFT JOIN product p ON s.s_prod_id = p.prod_id
WHERE s.s_invoice = '$invoice_no' AND s.s_status = '1' $expiration_condition;");

$data = array();

while ($row = mysqli_fetch_assoc($view_query)) {
    // Process and add data to the array as needed
    $data[] = $row;
}

// Return data as JSON
echo json_encode($data);
?>
