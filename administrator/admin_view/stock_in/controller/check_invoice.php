<?php
include("../.../../../../../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $invoiceNo = $_POST['invoice_no'];

  // Check if the invoice number exists in the database
  $query = "SELECT COUNT(*) as count FROM stocks_details WHERE ns_invoice = '$invoiceNo'";
  $result = mysqli_query($connections, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // Return response to JavaScript
    echo ($count > 0) ? 'exists' : 'not_exists';
  } else {
    // Handle the database error if needed
    echo 'error';
  }
} else {
  // Handle invalid requests
  echo 'invalid_request';
}
?>
