<?php

include "../../connection.php";
echo "<pre>";
print_r($_POST);

if (isset($_POST['btnArchive'])) {
    
    $transaction = htmlentities($_POST['transaction']);

    $sql = "UPDATE `orders` SET `display_status` = '1' WHERE `order_transaction_code` = '$transaction';";

    
    if (mysqli_query($connections, $sql)) {
        header("Location:adminpages/checkorders.php");
    } else {
        header("Location:adminpages/checkorders.php");
    }
}


if (isset($_POST['btnCancel'])) {
    $transaction = htmlentities($_POST['transaction']);
    
    $orders_id = $_POST['orders_id'];

    

    $sql = "UPDATE orders SET orders_status = 'Cancelled' WHERE order_transaction_code = '$transaction'";
     // Get the order ID and status from the AJAX request
  

     // Retrieve all orders_stock_id associated with the cancelled order
     $stock_id_query = "SELECT * FROM orders WHERE orders_id = '$orders_id' AND order_transaction_code='$transaction'";
     $stock_id_result = mysqli_query($connections, $stock_id_query);
 
     if ($stock_id_result && mysqli_num_rows($stock_id_result) > 0) {
         while ($row = mysqli_fetch_assoc($stock_id_result)) {
             $orders_stock_id = $row['orders_stock_id'];
        $cancelled_qty = $row['orders_qty'];
        $orders_status = $row['orders_status'];
 
             //orders_status
 
  
                 // Update the stock quantity in the stocks table
                 $update_stock_query = "UPDATE stocks SET s_amount = s_amount + '$cancelled_qty' WHERE s_id = '$orders_stock_id'";
                 $update_stock_result = mysqli_query($connections, $update_stock_query);
 
                 if (!$update_stock_result) {
                     // Update stock quantity failed
                     echo 'error';
                     exit; // Exit loop on error
 
 
             
        }
                
         }
 
   
     } else {
         // No matching order found
         echo 'error';
     }



    if (mysqli_query($connections, $sql)) {
        header("Location:../adminpages/checkorders.php");
    } else {
        header("Location:../adminpages/checkorders.php");
    }
}


 
?>


