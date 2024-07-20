<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$response = array();

include("../.../../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");

// Check if required fields are set
if (!isset($_POST["supplier_code"], $_POST["invoice_no"], $_POST["stockin_date"], $_POST["product"], $_POST["quantity"], $_POST["supplierPrice"])) {
    $response['status'] = 'error';
    $response['message'] = 'Required fields are missing';
    echo json_encode($response);
    exit();
}

// db_s_id
$supplier_code = mysqli_real_escape_string($connections, $_POST["supplier_code"]);
$invoice_no = mysqli_real_escape_string($connections, $_POST["invoice_no"]);
$stockin_date = mysqli_real_escape_string($connections, $_POST["stockin_date"]);
$product = mysqli_real_escape_string($connections, $_POST["product"]);
$qty = intval($_POST["quantity"]);
$db_s_id = intval($_POST["db_s_id"]);
$supplierPrice = floatval($_POST["supplierPrice"]);

// Check if the "expirationDate" key is set in $_POST
$expirationDate = isset($_POST["expirationDate"]) ? $_POST["expirationDate"] : NULL;

// Update data in stocks_details table
if ($expirationDate === NULL) {
    $updateQuery = "UPDATE stocks_details SET ns_stockin_date='$current_date', ns_qty='$qty', ns_supplierPrice='$supplierPrice' 
                    WHERE ns_stock_id='$db_s_id'";
} else {
    $updateQuery = "UPDATE stocks_details SET ns_stockin_date='$current_date', ns_expirationDate='$expirationDate', ns_qty='$qty', ns_supplierPrice='$supplierPrice' 
                    WHERE ns_stock_id='$db_s_id'";
}

if (mysqli_query($connections, $updateQuery)) {
    // Update data in stocks table
    $updateStocksQuery = "UPDATE stocks SET s_stockin_date='$current_date', s_expiration='$expirationDate', s_amount='$qty', s_supplierPrice='$supplierPrice' 
                          WHERE s_id ='$db_s_id'";

    if (mysqli_query($connections, $updateStocksQuery)) {
        $response['status'] = 'success';
        $response['message'] = 'Stock updated successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error updating data in stocks table: ' . mysqli_error($connections);
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error updating data in stocks_details table: ' . mysqli_error($connections);
}

// Set the content type
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
?>
