<?php
include "../../../connection.php";

$customer_name = $contact = $deliveryaddress = $email = $paymethod = $discountname = $discountrate = $latitude=$longitude="";
$attachment = "";
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

if (isset($_POST["btnCunfirm"])) {

    // Check if a file is uploaded
    if ($_FILES['attachment']['size'] > 0) {
        $attachment = $_FILES['attachment']['name'];
        $attachment_tmp = $_FILES['attachment']['tmp_name'];
        $attachment_dest = '../upload_proof/' . $attachment;
        move_uploaded_file($attachment_tmp, $attachment_dest);
    }

    echo '<pre>';
    // Generate Transaction Code
    $length = 5;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= mt_rand(0, 9);
    }


        $acc_id = $_POST['acc_id'];
        $prod_id =  $_POST['prod_id'];
        $prod_currprice =  $_POST['prod_currprice'];
      ///  $cart_id = $_POST['cart_id'];
        $total_price = $_POST["total_price"];
        $db_cart_prodQty = $_POST["db_cart_prodQty"];

        $discountname = $_POST["discountname"];
        $discountrate = $_POST["discountrate"];

        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];


        $orders_tax = $_POST["orders_tax"];
        $orders_ship_fee = $_POST["ship_fee"];

        $customer_id = $_POST["customer_id"];
        $nickname = $_POST["nickname"];
        $contact = $_POST["contact"];
        $deliveryaddress = $_POST["deliveryaddress"];
        $email = $_POST["email"];
        $paymethod = $_POST["paymethod"];

        date_default_timezone_set('Asia/Manila');
        $currentDateTime = date('Y-m-d g:i A');

        // Get product stocks
        $get_productStocks = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$prod_id'");
        $row_stocks = mysqli_fetch_assoc($get_productStocks);
        $db_prod_id = $row_stocks["prod_id"];

        // Start deduct
        $get_record = mysqli_query($connections, "
        SELECT *
        FROM product AS a
        LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
        WHERE a.prod_status = '0'
              AND a.prod_id = '$prod_id'
              AND s_amount > 0 
              AND (DATE(b.s_expiration) >= CURDATE() OR b.s_expiration = '0000-00-00')
        ORDER BY b.s_expiration ASC, b.s_created ASC;
        
        ");

        $remainingQty = $db_cart_prodQty;

        while ($row = $get_record->fetch_array()) {
            $db_s_id = $row["s_id"];
            $db_s_amount = $row["s_amount"];
            $db_s_expiration = $row["s_expiration"];

            if ($db_s_amount > 0 && ($db_s_expiration === '0000-00-00' || strtotime($db_s_expiration) >= strtotime('today'))) {
                $deductQty = min($remainingQty, $db_s_amount);
                $remainingQty -= $deductQty;

                // Update stocks
                mysqli_query($connections, "UPDATE stocks SET s_amount = s_amount - '$deductQty' WHERE s_id = '$db_s_id' ");

                // Insert into the database
                mysqli_query($connections, "
                    INSERT INTO orders
                    (orders_prod_id, order_transaction_code, orders_customer_id, 
                    orders_nickname, orders_email, orders_contact, orders_paymethod, 
                    orders_proof, orders_qty,orders_stock_id, orders_prod_price, orders_subtotal, orders_ship_fee, 
                    orders_tax, orders_voucher_name, orders_voucher_rate, orders_address,orders_latitude,orders_longitude,
                    orders_date, orders_status) 
                    VALUES (
                    '" . $prod_id . "', 
                    'RD" . $code . "', 
                    '" . $customer_id . "', 
                    '" . $nickname . "', 
                    '" . $email . "', 
                    '" . $contact . "', 
                    '" . $paymethod . "', 
                    '" . $attachment . "',
                    '" . $deductQty . "', 
                    '" . $db_s_id . "', 
                    '" . $prod_currprice . "', 
                    '" . ($prod_currprice * $deductQty) . "', 
                    '" . $orders_ship_fee . "', 
                    '" . $orders_tax . "', 
                    '" . $discountname . "', 
                    '" . $discountrate . "%', 
                    '" . $deliveryaddress . "', 
                    '" . $latitude . "', 
                    '" . $longitude . "', 
                    '" . $currentDateTime . "', 
                    'Pending')");
            }

            if ($remainingQty <= 0) {
                break;
            }
        }

       
      //  mysqli_query($connections, "DELETE FROM cart WHERE cart_id ='$cart_id' AND cart_user_id='$acc_id'");
   
    // Deduct voucher
    $orders_voucher_name="";
    $get_orderrecord = mysqli_query($connections, "SELECT * FROM orders WHERE order_transaction_code = 'RD$code'");
    $get_rowrecord = mysqli_fetch_assoc($get_orderrecord);
    $orders_voucher_name = $get_rowrecord["orders_voucher_name"];

    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    $view_query = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_expiration >= '$currentDateTime' AND voucher_name ='$orders_voucher_name'");
    while ($row = mysqli_fetch_assoc($view_query)) {
        $voucher_id = $row["voucher_id"];
        $db_voucher_name = $row["voucher_name"];
        $db_voucher_discount = $row["voucher_discount"];
        $db_voucher_discount_percent = $db_voucher_discount / 100;

        $db_voucher_created = $row["voucher_created"];
        $db_voucher_expiration = $row["voucher_expiration"];
        $db_voucher_maximumLimit = $row["voucher_maximumLimit"];
        $db_voucher_status = $row["voucher_status"];

        $db_voucher_maximumLimit -= 1;

        mysqli_query($connections, "UPDATE voucher SET voucher_maximumLimit='$db_voucher_maximumLimit' where voucher_name ='$orders_voucher_name'");
    }
}
echo "<script> window.location.href = '../../myOrders.php'; </script>";

exit ();
?>

<?php

if(isset($_POST['btnRemove'])){
    $value2 = $_POST['value2'];//order_transaction_code
    $order_id=$_POST['order_id'];
        
    // Perform the update query
    $update_query = mysqli_query($connections, "UPDATE orders SET display_status = '1' WHERE orders_id = '$order_id'");

    if($update_query) {
        
        echo "<script>window.location.href = 'inventory.php';</script>";
    } else {
        // Update failed
        echo "Update failed.";
    } 
    
}
?>