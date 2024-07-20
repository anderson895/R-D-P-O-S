<?php

$db_prod_name = "";
$db_prod_currprice = "";
$total_bill = 0;

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";


date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

foreach ($_POST['cart_id'] as $key => $value) {
    if (!empty($_POST['myCheckbox'][$key])) {

        $db_id =  $_POST['myCheckbox'][$key]; // This line is for prod_id
        $db_cart_prodQty = $_POST['qty'][$key];


    

        $view_query = mysqli_query($connections, "SELECT * FROM cart WHERE cart_prod_id IN ($db_id) AND cart_user_id='$acc_id'");
        $current_date = date("Y-m-d"); // Get the current date
        while ($row = mysqli_fetch_assoc($view_query)) {
            $db_cart_id = $row["cart_id"];
            $db_cart_prod_id = $row["cart_prod_id"];
            $db_cart_user_id = $row["cart_user_id"];

            $get_product_record = mysqli_query($connections, "SELECT *,
            SUM(IF(s.s_expiration = '0000-00-00' OR s.s_expiration > '$current_date', s.s_amount, 0)) AS prod_stocks
        FROM product AS a
        LEFT JOIN stocks AS s ON a.prod_id = s.s_prod_id
        LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
        WHERE a.prod_status = '0' 
            AND a.prod_id = '$db_cart_prod_id'
            AND (v.voucher_id IS NULL OR (v.voucher_expiration >= '$current_date' AND v.voucher_maximumLimit >= 1))
        GROUP BY a.prod_id");
        
            $row_product = mysqli_fetch_assoc($get_product_record);
            $db_prod_id = $row_product["prod_id"]; 
            $db_prod_name = $row_product["prod_name"]; 
            $db_prod_currprice = $row_product["prod_currprice"]; 
            $db_prod_unit_id = $row_product["prod_unit_id"]; 

            $db_prod_description = $row_product["prod_description"]; 
            $db_prod_image = $row_product["prod_image"]; 
            $db_prod_category_id = $row_product["prod_category_id"]; 

            $get_unit_record = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id='$db_prod_unit_id'");
            $row_unit = mysqli_fetch_assoc($get_unit_record);
            $db_unit_id = $row_unit["unit_id"]; 
            $db_unit_name = $row_unit["unit_name"];

            $db_voucher_name=$row_product["voucher_name"];
            $db_voucher_discount=$row_product["voucher_discount"]/100;
            $db_prod_currprice = $row_product["prod_currprice"];
            $getDiscountValue=$db_prod_currprice*$db_voucher_discount;
            $new_prod_currprice = $db_prod_currprice-$getDiscountValue;

            $original_total_price= $db_prod_currprice* $db_cart_prodQty;//original total price

            $total_price = $new_prod_currprice * $db_cart_prodQty; // deducted discount total price
            $total_bill += $total_price; // Add the total price to the total bill

            $get_taxt_value = ($db_system_tax/100) * $total_bill;
            $subtotal_deducted_tax = $total_bill + $get_taxt_value;
            
            ?>
            <input hidden type="text" value="<?= $db_cart_id ?>" name="cart_id[]">
         
            <input hidden type="text" value="<?= $db_acc_id ?>" name="acc_id[]">
           
            <input hidden type="text" value="<?= $db_prod_id ?>" id="prod_id" name="prod_id[]">
          
            <input hidden type="text" value="<?= $db_prod_currprice ?>" name="prod_currprice[]">

            <input hidden type="text" value="<?= $db_voucher_name ?>" name="db_voucher_name[]">

            <input hidden type="text" value="<?= $db_voucher_discount*100 ?>" name="db_voucher_discount[]">
           

            
             <div class="row mb-2">
    <div class="col-12 col-md-2">
        <picture>
            <source srcset="../upload_prodImg/<?=$db_prod_image?>" type="image/svg+xml">
            <img src="../upload_prodImg/<?=$db_prod_image?>" class="img-fluid img-thumbnail" alt="Product Image">
        </picture>
    </div>
    <div class="col-12 col-md-10">
        <p class="mb-2"><?php echo $db_prod_name ?></p>
        <?php if ($getDiscountValue > 0): ?>
            <p class="mb-2">
                <?php echo $db_voucher_name; ?><br>
                <span class="old-price text-decoration-line-through">₱ <?php echo $db_prod_currprice; ?></span>
                <span class="new-price">₱ <?php echo $new_prod_currprice; ?>
                    <?php if (!empty($_POST['myCheckbox'][$key])): ?>
                        x <?php echo $db_cart_prodQty; ?>
                    <?php endif; ?>
                </span>
            </p>
        <?php else: ?>
            <p class="mb-2">
                <span class="new-price">₱ <?php echo $new_prod_currprice; ?>
                    <?php if (!empty($_POST['myCheckbox'][$key])): ?>
                        x <?php echo $db_cart_prodQty; ?>
                    <?php endif; ?>
                </span>
            </p>
        <?php endif; ?>
    </div>
</div>






           


           
           
         
            
            <hr>
            <input hidden type="text" value="<?= $db_cart_prodQty ?>" name="db_cart_prodQty[]">
            <input hidden type="text" value="<?= $original_total_price ?>" name="total_price[]">
            <input hidden type="text" value="<?= $total_price ?>" name="new_total_price[]">
            

            
        <?php 
        }
    }
} 
?>