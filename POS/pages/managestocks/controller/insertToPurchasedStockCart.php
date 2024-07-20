<?php
include("../../../../connection.php");
echo "<pre>";
print_r($_POST);
echo "</pre>";


date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$sup_id = $_POST["supplierNameModal"];
$prod_id =  $_POST["productNameModal"];
$quantity = $_POST["quantity"];
$purchasePrice = $_POST["purchasePrice"];
$expirationDate = $_POST["expirationDate"];
$discount = $_POST["discount"];
$tax =  $_POST["tax"];
$purchased_Tax_Amount = $_POST["purchased_Tax_Amount"];
$purchased_Total_Cost_final = $_POST["purchased_Total_Cost_final"];
$referenceNo = $_POST["referenceNo"];
$acc_id = $_POST["acc_id"];


if($sup_id){
    if($prod_id){

        
                                    $query = "INSERT INTO purchasedcart (purchase_sup_id, purchase_prod_id, purchase_qty, purchase_price, purchase_expiration, purchased_discount, purchased_Tax, purchased_Tax_Amount, purchased_Total_Cost, purchased_date) 
                                    VALUES ('$sup_id', '$prod_id', '$quantity', '$purchasePrice', '$expirationDate', '$discount', '$tax', '$purchased_Tax_Amount', '$purchased_Total_Cost_final', '$currentDateTime')";

                                    if (mysqli_query($connections, $query)) {
                                        $last_id = mysqli_insert_id($connections);

                                        $get_record = mysqli_query ($connections, "SELECT * FROM supplier WHERE spl_id ='$sup_id'");
                                        $row = mysqli_fetch_assoc($get_record);
                                        $db_spl_name = $row["spl_name"];

                                        // Perform the user log insertion
                                        /*
                                        $userLogQuery = "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                        VALUES ('$acc_id', 'Purchased from supplier: $db_spl_name', '$currentDateTime', 'supplier', '$sup_id')";
                                        
                                        if (mysqli_query($connections, $userLogQuery)) {
                                            // Success, redirect or display a success message
                                            exit;
                                        } else {
                                            // Handle the SQL insert error for user log
                                            echo "Error inserting user log: " . mysqli_error($connections);
                                            exit;
                                        }*/
                                    } else {
                                        // Handle the SQL insert error
                                        echo "Error inserting data: " . mysqli_error($connections);
                                        exit;
                                    }
    
    }else{
        echo"prod_id is empty";
    }
}else{
    echo"sup_id is empty";
}

?>
