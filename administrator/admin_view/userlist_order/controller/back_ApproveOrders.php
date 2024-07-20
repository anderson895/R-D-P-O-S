<?php
include("../../../../connection.php");


echo "<pre>";
print_r($_POST);
echo "</pre>";

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d g:i A');







if(isset($_POST["btnDecline"])){

$acc_id=$_POST["acc_id"];
$orders_status=$_POST["orders_status"];
$transaction_code=$_POST["transaction_code"];
$customerFullname=$_POST['customerFullname'];
   
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Decline',orders_dates_delivered='$currentDateTime' WHERE order_transaction_code = '$transaction_code '");
  
    $stock_id_query = "SELECT orders_stock_id, orders_qty FROM orders WHERE order_transaction_code='$transaction_code'";
    $stock_id_result = mysqli_query($connections, $stock_id_query);
  
    if ($stock_id_result && mysqli_num_rows($stock_id_result) > 0) {
        while ($row = mysqli_fetch_assoc($stock_id_result)) {
            $orders_stock_id = $row['orders_stock_id'];
            $cancelled_qty = $row['orders_qty'];
  

            $update_stock_query = "UPDATE stocks SET s_amount = s_amount + '$cancelled_qty' WHERE s_id = '$orders_stock_id'";
            $update_stock_result = mysqli_query($connections, $update_stock_query);
  
            
            
            if (!$update_stock_result) {
              
                echo 'error';
                exit; // Exit loop on error
            }
        }
      //  header('Location: checkorders.php');
  
        //start user log
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', 'Decline $customerFullname`s order', Now(),'transaction','$transaction_code')");
        //end user log


    } else {
        // No matching order found
        echo 'error';
    }
    
  
  }
  
  
 
  
  
  
  
  if(isset($_POST["btnAcceptOrder"])){
    $acc_id=$_POST["acc_id"];
    $orders_status=$_POST["orders_status"];
    $transaction_code=$_POST["transaction_code"];
    $customerFullname=$_POST['customerFullname'];
 
   
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'To-ship' WHERE order_transaction_code = '$transaction_code '");


    //start user log
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', 'Accept $customerFullname`s order', Now(),'transaction','$transaction_code')");
    //end user log
    
  

  }
  
  
  
//customerFullname
  
    if(isset($_POST["btnToRecieved"])) {
      $acc_id=$_POST['acc_id'];
      $customerFullname=$_POST['customerFullname'];
      $orders_status = $_POST["orders_status"];
      $transaction_code = $_POST["transaction_code"];
      
      $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'To-receive', orders_dates_delivered = NOW() WHERE order_transaction_code = '$transaction_code'");
  
  //start user log
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', '$customerFullname`s order status change to recieve', Now(),'transaction','$transaction_code')");
    //end user log
  
    }
  
  
  
  
  
  if(isset($_POST["btnComplete"])){
    $acc_id=$_POST['acc_id'];
    $customerFullname=$_POST['customerFullname'];

    $orders_status=$_POST["orders_status"];
    $transaction_code=$_POST["transaction_code"];
      $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Completed' WHERE order_transaction_code = '$transaction_code '");
  
  //start user log
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', '$customerFullname`s order status change to recieve', Now(),'transaction','$transaction_code')");
    //end user log
  }

  
  if(isset($_POST["btnRemoveDisplay"])){
    $acc_id=$_POST['acc_id'];
    $customerFullname=$_POST['customerFullname'];

    $orders_status=$_POST["orders_status"];
    $transaction_code=$_POST["transaction_code"];
    $update_query = mysqli_query($connections, "UPDATE orders SET display_status = '1' WHERE order_transaction_code = '$transaction_code '");
  
  
  }

  
  
  //btnCancel
  
  if(isset($_POST["btnCancel"])){
    $orders_id=$_POST["orders_id"];
    $orders_status=$_POST["orders_status"];
    $transaction_code=$_POST["transaction_code"];
    $delete_query = mysqli_query($connections, "DELETE FROM orders WHERE order_transaction_code = '$transaction_code'");
  
  }
  
  
  //btnInvalid
  if(isset($_POST["btnInvalid"])){

    $orders_id=$_POST["orders_id"];
    $orders_status=$_POST["orders_status"];
    $transaction_code=$_POST["transaction_code"];
   
    // Retrieve all orders_stock_id associated with the cancelled order
    $stock_id_query = "SELECT orders_stock_id, orders_qty FROM orders WHERE orders_prod_id = '$productId' AND order_transaction_code='$transaction_code'";
    $stock_id_result = mysqli_query($connections, $stock_id_query);
  
     
  
       // Update the stock quantity in the stocks table
       while ($row = mysqli_fetch_assoc($stock_id_result)) {
        $orders_stock_id = $row['orders_stock_id'];
        $cancelled_qty = $row['orders_qty'];
  
  
       $update_stock_query = "UPDATE stocks SET s_amount = s_amount + '$cancelled_qty' WHERE s_id = '$orders_stock_id'";
       $update_stock_result = mysqli_query($connections, $update_stock_query);
  
       if (!$update_stock_result) {
           // Update stock quantity failed
           echo 'error';
           exit; // Exit loop on error
       }
      }
  
       $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Invalid' WHERE order_transaction_code = '$transaction_code '");
  
      
  
  }
  ?>