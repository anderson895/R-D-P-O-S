<?php
include "../../connection.php";
include "back_navbar.php";
$order_change="";
$db_cart_user_id=$finalTotalDisplay = $discount = $pos_cart_id = $pos_cart_user_id = $Payment = $order_change = $prod_id = $prodqty = "";
$db_acc_idErr=$finalTotalDisplayErr = $discountErr = $pos_cart_idErr = $pos_cart_user_idErr = $PaymentErr = $prod_idErr = $prodqtyErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment = $_POST["Payment"];
    $paymentErr = "";

    // Perform validation
    if (empty($payment)) {
        $paymentErr = "Payment is required";
    } else {
        $Payment = $_POST["Payment"];
        $finalTotalDisplay = $_POST["finalTotalDisplay"];
        $pos_cart_user_id = $_POST["pos_cart_user_id"];

        if($_POST["discount"]=="0"){


         
          $db_discount_name = null;
          $db_discount_rate = 0;

        }else{
            
        $discountname = $_POST["discountname"];


            if($discountname){
            $discount_query = mysqli_query($connections, "SELECT * FROM `discount` where discount_name='$discountname'");
            $d_row = mysqli_fetch_assoc($discount_query);
            $db_discount_id = $d_row["discount_id"];
            $db_discount_name = $d_row["discount_name"];
            $db_discount_rate = $d_row["discount_rate"];

            }else{
                $db_discount_name = null;
                $db_discount_rate = null;
            }
        }
    
      
  
        $db_system_tax=$_POST["db_system_tax"];
        $stringValue = $finalTotalDisplay;
        $numericFinal = floatval(str_replace(',', '', $stringValue));
    }

    if (is_numeric($Payment)==True) {

    
            if ($Payment >= $numericFinal) {

                if($numericFinal>=1){

                  //generate Transaction Code
                $length = 5; // Desired length of the code
                $code = '';
                
                for ($i = 0; $i < $length; $i++) {
                    $code .= mt_rand(0, 9); // Append a random number between 0 and 9
                }

                    foreach ($_POST['pos_cart_id'] as $key => $value) {
                       $pos_cart_id=$_POST['pos_cart_id'][$key];
                        $prod_id = $_POST['prod_id'][$key];
                        $prodqty = $_POST["prodqty"][$key];
                        $db_cart_user_id=$_POST["db_cart_user_id"];
                       
            

                $order_change = $Payment - $numericFinal;

            

               

                date_default_timezone_set('Asia/Manila');
                $currentDateTime = date('Y-m-d g:i A');

                mysqli_query($connections, "INSERT INTO pos_orders(orders_tcode,orders_cart_id,orders_prod_id,orders_prodQty,orders_discount,orders_discount_name,orders_tax,orders_date,orders_final,orders_payment,orders_change,orders_user_id,orders_status) 
                    VALUES('RD$code','$pos_cart_id','$prod_id','$prodqty','$db_discount_rate','$db_discount_name','$db_system_tax','$currentDateTime','$numericFinal','$Payment','$order_change','$db_cart_user_id','done')");



$get_record = mysqli_query($connections, "SELECT * FROM product as a
LEFT JOIN stocks as b ON a.prod_id = b.s_prod_id
WHERE a.prod_status = '0' AND a.prod_id = '$prod_id'
ORDER BY b.s_created ASC");

$remainingQty = $prodqty; // Track the remaining quantity

while ($row = $get_record->fetch_array()) {
$db_s_id = $row["s_id"];
$db_s_amount = $row["s_amount"];

if ($db_s_amount > 0) {
$deductQty = min($remainingQty, $db_s_amount); // Deduct the minimum of remainingQty and db_s_amount
$remainingQty -= $deductQty; // Update the remaining quantity

mysqli_query($connections, "UPDATE stocks
SET s_amount = s_amount - '$deductQty'
WHERE s_id = '$db_s_id'");

if ($remainingQty == 0) {
// All quantity has been deducted, exit the loop
break;
}
}
}
                     mysqli_query($connections, "DELETE FROM pos_cart WHERE pos_cart_id  = '$pos_cart_id' AND pos_cart_user_id='$db_cart_user_id' ");
            }
              ////log
              date_default_timezone_set('Asia/Manila');
              $currentDateTime = date('Y-m-d g:i A');

              mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
              VALUES('$db_cart_user_id', 'CASHIERING IN TRANSACTION: RD$code', '$currentDateTime')");
              //log


           echo '
              <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
              <script>
                  swal({
                      title: "Success!",
                      text: "Your Change is PHP ' . $order_change . ' ",
                      icon: "success",
                      html: true
                  }).then((value) => {
                      if (value) {
                          window.location.href = "receipt.php?RDcode=RD'.$code.'";
                          // Display the print receipt code here
                         
                      } else {
                          window.location.reload();
                      }
                  });
              </script>
          ';
        
          
            
                
                } else {
                   
                }
            
                }else{
                    echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
                    <script>
                        swal("Failed!", "Payment is Insufficient.", "error");
                    </script>
                ';
                }
    }else{
        $paymentErr="Numeric Value Only";

    }

    // Return the validation result
   echo $paymentErr;
    }
?>


