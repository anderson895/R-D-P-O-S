<?php

function SelectAddress($connections)
{
    
if (isset($_SESSION["acc_id"])) {
    include("../connection.php");
    $acc_id = $_SESSION["acc_id"];
    $fullname = "";
    
    // Prepare the SQL statement using a parameterized query
    $stmt = $connections->prepare("SELECT * FROM account 
    LEFT JOIN user_address ON account.acc_code = user_address.user_acc_code 
    LEFT JOIN tbl_address ON tbl_address.address_region_code = user_address.user_region_code 
    WHERE account.acc_id = ? 
    AND user_address.user_active_status = '1' 
    AND tbl_address.address_region_code = user_address.user_region_code");



    
    // Bind the parameter value
    $stmt->bind_param("s", $acc_id);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_acc_id = $row["acc_id"];
        $db_acc_fname = $row["acc_fname"];
        $db_acc_lname = $row["acc_lname"];
        $db_emp_image = $row["emp_image"];
        
        $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
        $db_acc_contact = $row["acc_contact"];
    
        $db_acc_username = $row["acc_username"];
        $db_acc_password = $row["acc_password"];
        $db_acc_username = $row["acc_username"];
        $db_acc_type = $row["acc_type"];
        $db_acc_email = $row["acc_email"];


        $user_acc_code = $row["user_acc_code"];
        $user_region_name = $row["user_region_name"];
    
        $address_region_code  = $row["address_region_code"];
        $address_rate  = $row["address_rate"];
        $user_complete_address = $row["user_complete_address"];

        $users_latitude = $row["users_latitude"];
        $users_longitud = $row["users_longitud"];
  
    
    $db_acc_id = $_SESSION["acc_id"];
  

    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');


    $html .= '<option disabled selected>Select Address</option>';

    $stmt = $connections->prepare("SELECT id, user_complete_address FROM account 
        LEFT JOIN user_address ON account.acc_code = user_address.user_acc_code 
        LEFT JOIN tbl_address ON tbl_address.address_region_code = user_address.user_region_code 
        WHERE account.acc_id = ?
        AND user_address.user_add_display_status='1'
        ");

    $stmt->bind_param("i", $db_acc_id); // Bind the parameter

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $address = $row["user_complete_address"];
        $selected = ($user_complete_address == $address) ? 'selected' : '';

        $html .= '<option ' . $selected . ' value="' . $id . '">' . $address . '</option>';
    }



    echo $html;
}
}
}






function generateDiscountSelect($connections)
{
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    $html = '<select class="form-select" id="discount-select" onchange="updateDiscountName()" aria-label="Default select example" style="width:100%; margin: 0 auto; display: block;">';

    $html .= '<option selected>Select Discount Voucher</option>';

    $view_query = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_expiration >= '$currentDateTime' AND voucher_maximumLimit >= 1 ");

    while ($row = mysqli_fetch_assoc($view_query)) {
        $voucher_id = $row["voucher_id"];
        $db_voucher_name = $row["voucher_name"];
        $db_voucher_discount = $row["voucher_discount"];
        $db_voucher_discount_percent = $db_voucher_discount / 100;

        $db_voucher_created = $row["voucher_created"];
        $db_voucher_expiration = $row["voucher_expiration"];
        $db_voucher_maximumLimit = $row["voucher_maximumLimit"];
        $db_voucher_status = $row["voucher_status"];

        $html .= '<option value="' . $db_voucher_discount_percent . '">' . $db_voucher_name . '</option>';
    }

    $html .= '</select>';

    echo $html;
}



?>
<?php
function displayCartItems($connections, $acc_id, $db_system_tax)
{
    $total_bill = 0;

    foreach ($_POST['cart_id'] as $key => $value) {
        if (!empty($_POST['myCheckbox'][$key])) {

            $db_id =  $_POST['myCheckbox'][$key];
            $db_cart_prodQty = $_POST['qty'][$key];

            $view_query = mysqli_query($connections, "SELECT * FROM cart WHERE cart_prod_id IN ($db_id) AND cart_user_id='$acc_id'");

            while ($row = mysqli_fetch_assoc($view_query)) {
                $db_cart_id = $row["cart_id"];
                $db_cart_prod_id = $row["cart_prod_id"];
                $db_cart_user_id = $row["cart_user_id"];

                $get_product_record = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$db_cart_prod_id'");
                $row_product = mysqli_fetch_assoc($get_product_record);
                $db_prod_id = $row_product["prod_id"];
                $db_prod_name = $row_product["prod_name"];
                $db_prod_currprice = $row_product["prod_currprice"];
                $db_prod_unit_id = $row_product["prod_unit_id"];
                $db_prod_image = $row_product["prod_image"];
                $db_prod_category_id = $row_product["prod_category_id"];

                $get_unit_record = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id='$db_prod_unit_id'");
                $row_unit = mysqli_fetch_assoc($get_unit_record);
                $db_unit_id = $row_unit["unit_id"];
                $db_unit_name = $row_unit["unit_name"];

                $total_price = $db_prod_currprice * $db_cart_prodQty;
                $total_bill += $total_price;

                $get_taxt_value = $db_system_tax * $total_bill;
                $subtotal_deducted_tax = $total_bill + $get_taxt_value;
            ?>

                <br>
                <input hidden type="text" value="<?php echo $db_cart_id ?>" name="cart_id[]">
                <input hidden type="text" value="<?php echo $acc_id ?>" name="acc_id[]">
                <input hidden type="text" value="<?php echo $db_prod_id ?>" name="prod_id[]">
                <input hidden type="text" value="<?php echo $db_prod_currprice ?>" name="prod_currprice[]">
                <p class="mb-2"><strong>Items</strong>: <?php echo $db_prod_name ?></p>
                <p class="mb-2"><strong>Price</strong>: <?php echo $db_prod_currprice ?></p>

                <?php if (!empty($_POST['myCheckbox'][$key])): ?>
                    <p class="mb-2"><strong>Quantity</strong>: <?php echo $db_cart_prodQty ?></p>
                <?php endif; ?>

                <p class="mb-2"><strong>Total</strong>:<span>&#8369;</span> <?php echo number_format($total_price, 2, '.', ',') ?></p>
                <hr>
                <input hidden type="text" value="<?php echo $db_cart_prodQty ?>" name="db_cart_prodQty[]">
                <input hidden type="text" value="<?php echo $total_price ?>" name="total_price[]">
                <br>

                
<?php
            }
        }
    }

    // You can return or use the $total_bill or $subtotal_deducted_tax here if needed.
}


?>