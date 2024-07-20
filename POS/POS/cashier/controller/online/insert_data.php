<?php
// insert_data.php



$tcode="";
if (isset($_POST["buttonSUbmit"])) {
    include "../../../../connection.php";
    print_r($_POST);
    // Get the data from the AJAX request
    $product_date = $_POST["product_date"];
    $transactionCode = $_POST['tcode'];
    $request = $_POST['Request'];
    $reason = $_POST['reason'];
    $customerName = $_POST['cname'];
    $contactNumber = $_POST['cnom'];
    $address = $_POST['address'];

    // Loop through the selected products
    foreach ($_POST['product'] as $key => $productCode) {
        // Check if the corresponding product quantity is set in the $_POST['product_qty'] array
        $quantity = isset($_POST['product_qty'][$key]) ? $_POST['product_qty'][$key] : 0;

        // Escape variables to prevent SQL injection (or use prepared statements, see below)
        $prodCode = mysqli_real_escape_string($connections, $productCode);
        $quantity = mysqli_real_escape_string($connections, $quantity);

        // Assuming your table has columns named `ret_transaction_code`, `ret_product_code`, `ret_qty`, etc.
        $query = "INSERT INTO `return_ordering` (ret_ol_date, ret_ol_datepurchase, `ret_ol_transaction_code`, `ret_ol_product_code`, `ret_ol_qty`, `ret_ol_request`, `ret_ol_reason`, `ret_ol_customer_name`, `ret_ol_contact_number`, `ret_ol_address`)
         VALUES (current_timestamp(), '$product_date[$key]', '$transactionCode', '$prodCode', '$quantity', '$request', '$reason', '$customerName', '$contactNumber', '$address')";
      
      
    //    $quantity;

   

        
        mysqli_query($connections, $query);
    }

    // Display the selected products using print_r
    // Uncomment the line below for debugging purposes
    // print_r($_POST);

    // Redirect to a success page or perform any other actions after data insertion
    header("Location: ../../return_online.php");
    exit();
} else {
    // If the request is not via POST, handle accordingly (optional)
    $response = array('status' => 'error', 'message' => 'Invalid request method');
}
?>
