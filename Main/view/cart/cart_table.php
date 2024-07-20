<?php 
//include "controller/function/voucher.php";  
?>

<style>/* Media query for mobile view */
@media (max-width: 767px) {
    .product_info {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .product_img {
        margin-bottom: 10px;
    }

    .product_wrap {
        width: 100%;
    }

    .product_data {
        width: 100%;
    }

    .description {
        margin-bottom: 10px;
    }

    .discount {
        text-align: center;
    }

    .qty-input {
        width: 50px;
        text-align: center;
    }

    .discount button {
        margin: 0 5px;
        padding: 5px 10px;
    }
}
</style>


<?php
date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$prod_stocks = "";
$total_bill = 0;

$view_product_query = mysqli_query($connections, "SELECT *, SUM(a.cart_prodQty) as qty 
    FROM cart as a 
    LEFT JOIN product as b ON a.cart_prod_id = b.prod_id
    WHERE a.cart_user_id='{$_SESSION['acc_id']}'
    GROUP BY a.cart_prod_id
    ORDER BY `cart_id` ASC
    ");

while ($product_row = mysqli_fetch_assoc($view_product_query)) {
    $db_cart_id = $product_row["cart_id"];
    $db_prod_id = $product_row["prod_id"];
    $db_prod_name = $product_row["prod_name"];
    $db_prod_description = $product_row["prod_description"];
    $db_prod_image = $product_row["prod_image"];
    $db_cart_prodQty = $product_row["cart_prodQty"];

    $current_date = date("Y-m-d"); // Get the current date
    $view_query = mysqli_query($connections, "SELECT *,
        SUM(IF(s.s_expiration = '0000-00-00' OR s.s_expiration > '$current_date', s.s_amount, 0)) AS prod_stocks
        FROM product AS a
        LEFT JOIN stocks AS s ON a.prod_id = s.s_prod_id
        LEFT JOIN voucher AS v ON a.prod_voucher_id = v.voucher_id
        WHERE a.prod_status = '0' 
            AND a.prod_id = '$db_prod_id'
            AND (v.voucher_id IS NULL OR (v.voucher_expiration >= '$current_date' AND v.voucher_maximumLimit >= 1))
        GROUP BY a.prod_id
    ");

    $row = mysqli_fetch_assoc($view_query);
    $stocks = $row["s_amount"];
    $prod_stocks = $row["prod_stocks"];
    $db_prod_voucher_id = $product_row["prod_voucher_id"];
    $db_voucher_name = $row["voucher_name"];
    $db_voucher_discount = $row["voucher_discount"] / 100;
    $db_prod_currprice = $product_row["prod_currprice"];
    $getDiscountValue = $db_prod_currprice * $db_voucher_discount;
    $new_prod_currprice = $db_prod_currprice - $getDiscountValue;
    $db_prod_unit = $product_row["prod_unit_id"];
    $db_qty = $product_row["qty"];

    $total_price = $new_prod_currprice * min($db_qty, $prod_stocks);
    $total_bill += $total_price;

    $get_record_unit = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id ='$db_prod_unit' ");
    $row_unit = mysqli_fetch_assoc($get_record_unit);
    $unit_name = $row_unit["unit_name"];

    echo '<div class="product_wrap" >';
    if ($prod_stocks <= 0) {
        echo '<input type="checkbox"   value="' . $db_prod_id . '" disabled>';
    } else {
        echo '<input type="checkbox" checked name="myCheckbox[]" value="' . $db_prod_id . '" data-total-price="' . $total_price . '">';
    }
    echo '<label for="myCheckbox">Check</label>';

    echo '<div class="product_info"  >';
    echo '<div class="product_img" >';
    if ($db_prod_image) {
        if ($prod_stocks <= 0) {
            echo '<div style="position: relative; display: inline-block;">';
            echo '<img src="../upload_prodImg/' . $db_prod_image . '" alt="ProductImage" width="250px" height="150px">';
            echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">';
            echo '<h4 style="color:red; background-color:rgba(255, 255, 255, 0.5);" >NOT AVAILABLE</h4>';
            
            echo '</div>';
            echo '</div>';
            
        } else {
            echo '<img src="../upload_prodImg/' . $db_prod_image . '" alt="ProductImage" width="250px" height="250px">';
        }
    } else {
        echo '<img src="../assets/img/1599802140_no-image-available.png" alt="" style="width: 200px; height: 150px;">';
    }
    echo '</div>';

    echo '<div hidden class="product_wrap">';
    echo '<input id="db_cart_id" type="text" name="cart_id[]" class="cart-id" value="' . $db_cart_id . '">';
    echo '</div>';

    echo '<div class="product_data">';
    echo '<div class="description">';
    echo '<div class="main_header">' . ucwords($db_prod_name) . '</div>';
    echo '<div class="sub_header">' . $db_prod_description . '</div>';
    echo '</div>';

    if ($getDiscountValue > 0) {
        echo '<div class="container">';
        echo '  <div class="row" >';
        echo '    <div class="col-md-12 text-center">'; // Center the content within the column
        echo '      <div id="currprice">' . $db_voucher_name . '</div>';
        echo '      <div class="text-decoration-line-through" id="currprice">₱' . number_format($db_prod_currprice, 2, '.', ',') . '</div>';
        echo '      <div id="currprice">₱' . number_format($new_prod_currprice, 2, '.', ',') . '</div>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        
    } else {
        echo '  <div  id="currprice">  ₱' . number_format($new_prod_currprice, 2, '.', ',') . '</div>';
    }

    if ($prod_stocks) {
        echo '<hr>';
        echo '<div class="discount">';
        echo '    <div class="input-group">';
        echo '        <button type="button" class="m-btn btn btn-default decrease input-group-prepend" onclick="decreaseQuantity(this)" data-id="' . $db_cart_id . '" data-price="' . $new_prod_currprice . '"><i class="fa fa-minus"></i></button>';
        echo '        <input class="form-control text-center border-0 qty-input" name="qty[]" id="inputField_' . $db_cart_id . '" type="number" value="' . min($db_qty, $prod_stocks) . '" min="1" max="' . $prod_stocks . '" oninput="updateTotalPrice(' . $db_cart_id . ', ' . $new_prod_currprice . ')" data-cart-id="' . $db_cart_id . '" required>';
        echo '        <button type="button" class="m-btn btn btn-default input-group-prepend" onclick="increaseQuantity(this)" data-id="' . $db_cart_id . '" data-price="' . $new_prod_currprice . '"><i class="fa fa-plus"></i></button>';
        echo '    </div>';
        echo '</div>';

        echo '<br>';

        echo '<div class="discount">';
        echo '    Total ₱ <font style="color:red;" id="consoleLogContent_' . $db_cart_id . '">' . number_format($total_price, 2, '.', ',') . '</font>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';

    echo '<div class="product_btns">';
    echo '    <div class="remove remotogler" data-bs-toggle="modal" data-bs-target="#modalRemoveConfirm" data-db_prod_id="' . $db_prod_id . '" data-db_prod_name="' . $db_prod_name . '">';
    echo '        Remove';
    echo '    </div>';
    
    // Dagdag na button na nasa gitna
    //echo '    <div class="remove">';

  //  echo '    </div>';
    
   // echo '    <div class="remove" data-bs-toggle="modal" data-bs-target="#modalAddtoWishlist" data-db_prod_id="' . $db_prod_id . '" data-db_prod_name="' . $db_prod_name . '">';
   // echo '        Wishlist';
   // echo '    </div>';
    echo '</div>';
    

    

    echo '</div>';
}
?>


<script>
  
  const qtyInputs = document.querySelectorAll('.qty-input');
  
  qtyInputs.forEach(function(input) {
    input.addEventListener('input', function(event) {
      const maxValue = parseInt(this.getAttribute('max'));
      if (parseInt(this.value) > maxValue) {
        this.value = maxValue; // Set the value not exceeding $prod_stocks
      }
    });
  });
</script>



