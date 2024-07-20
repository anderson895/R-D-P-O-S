<?php 
include "../administrator/connection.php";
include "navigation.php"; 
//confirmDeliver
if (isset($_POST["confiem"])) {
  $transactionId = $_POST["transactionId"];

  // Call data from the product table


 
  
/* */

      
      $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'In-Transit' WHERE order_transaction_code = '$transactionId '");

    



      // start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'DELIVER TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";
 


  }


if(isset($_POST["confirmDeliver"])){
    $transactionId=$_POST["transactionId"];
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d g:i A');
   
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Delivered',orders_dates_delivered='$currentDateTime' WHERE order_transaction_code = '$transactionId '");

    // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'DELIVERED TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";

}
//btnArchive
if(isset($_POST["btnArchive"])){
    $transactionId=$_POST["transactionId"];
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Complete' WHERE order_transaction_code = '$transactionId '");

    // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'ARCHIVE TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";

}



//btnCancel

if(isset($_POST["btnCancel"])){
  $transactionId = $_POST["transactionId"];
  $delete_query = mysqli_query($connections, "DELETE FROM orders WHERE order_transaction_code = '$transactionId'");
  // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'CANCEL TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
  echo "<script> window.location.href = 'deliver.php'; </script>";
}


//btnInvalid
if(isset($_POST["btnInvalid"])){
  $transactionId=$_POST["transactionId"];
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Not Delivered' WHERE order_transaction_code = '$transactionId '");

    // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'NOT DELIVERED TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";

}
?>