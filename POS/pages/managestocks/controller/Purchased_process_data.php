<?php
include("../../../../connection.php");
echo "<pre>";
print_r($_POST);
echo "</pre>    ";
// Extract data from POST

date_default_timezone_set('Asia/Manila');
echo $currentDateTime = date('Y-m-d H:i:s');



$supplier = $_POST['supplier'];
$referenceNo = $_POST['referenceNo'];
$acc_id = $_POST['acc_id'];

// Insert data into the database
foreach ($_POST['tableData'] as $row) {
    $productName =  $row['productName'];
    $qty =  $row['qty'];
    $purchasePrice = $row['price'];
    $discount =  $row['Discount'];
    $tax = $row['Tax'];
    $taxAmount = $row['TaxAmount'];
    $totalCost = $row['TotalCost'];
    $prod_id = $row['prod_id'];
    $expiration=$row['Expiration'];
    

    $insertQuery = "INSERT INTO purchased_record (precord_sup_id, precord_prod_id,precord_reference, precord_qty, precord_price,precord_expiration,precord_discount, precord_Tax, precord_Tax_Amount, precord_Total_Cost,precord_date)
                    VALUES ('$supplier','$prod_id','$referenceNo', '$qty', '$purchasePrice','$expiration','$discount', '$tax', '$taxAmount', '$totalCost','$currentDateTime')";

    $insertStocks = "INSERT INTO stocks (s_created,s_precord_reference,s_expiration,s_prod_id,s_amount,s_spl_id)
                        VALUES ('$currentDateTime','$referenceNo','$expiration','$prod_id','$qty','$supplier')";


    mysqli_query($connections, $insertQuery);
    mysqli_query($connections, $insertStocks);

    mysqli_query($connections,"DELETE FROM purchasedcart WHERE purchase_sup_id='$supplier'");
}

        $get_record = mysqli_query ($connections,"SELECT * FROM supplier where spl_id ='$supplier' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_spl_name = $row["spl_name"];

$userLogQuery = "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
VALUES ('$acc_id', 'Purchased order from supplier: $db_spl_name', '$currentDateTime', 'supplier', '$supplier')";

if (mysqli_query($connections, $userLogQuery)) {
    // Success, redirect or display a success message
    exit;
} else {
    // Handle the SQL insert error for user log
    echo "Error inserting user log: " . mysqli_error($connections);
    exit;
}

// Send a response (you can customize the response as needed)
$response = array('message' => 'Data successfully processed and inserted into the database.');
echo json_encode($response);
?>
