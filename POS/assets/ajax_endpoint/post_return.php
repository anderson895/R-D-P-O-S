<?php 

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

<?php
date_default_timezone_set('Asia/Manila');

include('../../config/config.php');
session_start();


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Access the posted data
    $reason = $_POST['reason'];
    $returnType = $_POST['returnType'];
    $productReturnInfo = $_POST['productReturnInfo'];
    $datePurchase = $_POST['datePurchase'];
    $transactionCode = $_POST['transactionCode'];


    $acc_id=$_SESSION["acc_id"];

    
    foreach ($productReturnInfo as $item) {
        $prodId = $item['prodId'];
        $quantity = $item['quantity'];
        $currprice=$item["currprice"];

   mysqli_query($conn,"INSERT INTO returns_pos(ret_date,ret_datepurchase,ret_transaction_code,ret_product_id,ret_qty,ret_prod_price,ret_type,ret_reason,ret_cashier_id,ret_status) 
    VALUES(Now(),'$datePurchase','$transactionCode','$prodId','$quantity','$currprice','$returnType','$reason','$acc_id','0')");
        
        mysqli_query($connections,"UPDATE pos_orders SET return_availability='1' WHERE orders_prod_id='$prodId'");
        
    }

    
    echo "Data received successfully!";
} else {
    // Handle non-POST requests
    echo "Invalid request method.";
}
?>
