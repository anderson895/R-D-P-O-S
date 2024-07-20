<?php

$response = array();

include("../.../../../../../connection.php");


date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");

$supplier_code = $_POST["supplier_code"];
$invoice_no = $_POST["invoice_no"];
$stockin_date = $_POST["stockin_date"];
$product = $_POST["product"];
$qty = $_POST["quantity"];
$supplierPrice = $_POST["supplierPrice"];

// Check if the "expirationDate" key is set in $_POST
$expirationDate = isset($_POST["expirationDate"]) ? $_POST["expirationDate"] : NULL;





// Retrieve product ID
$getRecordProduct = mysqli_query($connections, "SELECT * FROM product WHERE prod_code='$product'");
$rowProduct = mysqli_fetch_assoc($getRecordProduct);
$db_prod_id = $rowProduct["prod_id"];

// Retrieve supplier ID
$getRecordSupplier = mysqli_query($connections, "SELECT * FROM supplier WHERE spl_code='$supplier_code'");
$rowSupplier = mysqli_fetch_assoc($getRecordSupplier);
$db_spl_id = $rowSupplier["spl_id"];

// Insert data into stocks table




$insertStocksQuery = "INSERT INTO stocks(s_stockin_date, s_invoice, s_expiration, s_prod_id,s_stock_in_qty ,s_amount, s_spl_id, s_status,s_supplierPrice) 
                          VALUES ('$current_date','$invoice_no', '$expirationDate', '$db_prod_id','$qty' ,'$qty', '$db_spl_id', '1', '$supplierPrice')";

if (mysqli_query($connections, $insertStocksQuery)) {

    $last_id = mysqli_insert_id($connections);
    // Insert data into stocks_details table
    if ($expirationDate === NULL) {
        $insertQuery = "INSERT INTO stocks_details(ns_supplier_code,ns_stock_id, ns_invoice, ns_stockin_date, ns_product_code, ns_qty, ns_supplierPrice) 
                            VALUES ('$supplier_code','$last_id', '$invoice_no', '$current_date', '$product', '$qty', '$supplierPrice')";
    } else {
        $insertQuery = "INSERT INTO stocks_details(ns_supplier_code,ns_stock_id, ns_invoice, ns_stockin_date, ns_product_code, ns_expirationDate, ns_qty, ns_supplierPrice) 
                            VALUES ('$supplier_code','$last_id', '$invoice_no', '$current_date', '$product', '$expirationDate', '$qty', '$supplierPrice')";
    }
    mysqli_query($connections, $insertQuery);

    $response['status'] = 'success';
    $response['message'] = 'Stock added successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error inserting data into stocks table: ' . mysqli_error($connections);
}








// Set the content type
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
