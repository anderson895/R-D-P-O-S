<div class="items color-black ">
            <div class="container" style="margin-top: 20px;">
                <h1 class="color-gray">Cart List</h1>
            </div>

            <div class="div-table">
                <table class="table-cart" style="color:black;">
                    <tr class="head-row">
                        <td width="30%">Item</td>
                        <td width="20%">Price</td>
                        <td width="25%">Qty</td>
                        <td width="20%" >Total</td>
                        <td width="5%">Action</td>
                    </tr>
                    
                    <?php
                     $finalTotal =0;
                        $query = "SELECT *, SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', stocks.s_amount, 0)) AS prod_stocks
                         FROM pos_cart 
                        INNER JOIN product ON pos_cart.pos_cart_prod_id = product.prod_id
                        LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id 
                        where pos_cart_user_id='$acc_id'
                        ";
                        // Execute the query
                        $result = $conn->query($query);

                        $totalSum = 0; // Initialize total sum

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $subtotal = $row["prod_currprice"] * $row["cart_prodQty"];
                                $totalSum += $subtotal; // Accumulate subtotals for total sum
                                $string = $row["prod_name"];
                                $maxLength = 17;
                                if (strlen($string) > $maxLength) {
                                    $limitedString = substr($string, 0, $maxLength) . "...";
                                } else {
                                    $limitedString = $string;
                                }
                                $pos_cart_id = $row["pos_cart_id"]; // Add this line to fetch the cart ID
                                $cart_prodQty = $row["cart_prodQty"]; // Add this line to fetch the cart ID
                                $prod_stocks = $row["prod_stocks"]; // this is the stock ammount
                                $Addtax=$totalSum*$db_system_tax;
                                $finalTotal=$totalSum+$Addtax;
                                echo '
                                <tr>
                                    <td>
                                    '.$limitedString.'
                                    </td>
                                    <td>
                                   
                                    <var class="price price'. $pos_cart_id.'">'.number_format($row["prod_currprice"] , 2, '.', ',').'</var> 
                               
                                    </td>
                                    <td>
                                    <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                        <button type="button" class="m-btn btn btn-default decrease" onclick="decreaseQuantity(this)" data-id="'.$pos_cart_id.'">-</button>
                                        <button style="color:black;" type="button" class="m-btn btn btn-default" disabled>'.$cart_prodQty.'</button>
                                        <button type="button" class="m-btn btn btn-default" onclick="increaseQuantity(this)" data-id="'.$pos_cart_id.'">+</button>
                                    </div>
                                    </td>
                                    <td>
                                    
                                   
                                    <var class="price total total'.$pos_cart_id.'">'.number_format($subtotal, 2, '.', ',').'</var> 
                                    </td>
                                    <td><form action="controller/pos/cashier_functions.php" method="POST"><input type="hidden" name="cart_id" value="'.$pos_cart_id.'"><button type="submit" name="btn_delete" class="delete"><img style="width: 25px;" alt="" src="../assets/images/icons8-delete-30.png"></button></form></td>
                                </tr>';
                            }
                        } else {
                            echo '<td colspan="5">Empty Cart</td>';
                        }
                    ?>
                </table>
            </div>
            
            <?php
                // SQL query to calculate the total cost
               $current_date = date("Y-m-d"); // Get the current date
              //  SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
                $query = "SELECT SUM(product.prod_currprice * pos_cart.cart_prodQty) AS total_cost
                FROM pos_cart 
                INNER JOIN product ON pos_cart.pos_cart_prod_id = product.prod_id 
                
                WHERE pos_cart_user_id = '$acc_id'";

                $result = $conn->query($query);

                if ($result) {
                $row = $result->fetch_assoc();
                $total = $row['total_cost'];
                $totalCost = number_format($total, 2, '.', ',');

                } else {
                
                }
            ?>

                 <?php 
               include "view/index/checkout_container.php";
                 ?>
        </div>
