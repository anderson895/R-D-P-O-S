
<?php 
$combined_subtotals = array();
if (mysqli_num_rows($view_query) > 0) {
    while ($row = mysqli_fetch_assoc($view_query)) {
        $orders_prod_id = $row["orders_prod_id"];
        $orders_subtotal = $row["subtotal"];
    
        
        if (isset($combined_subtotals[$orders_prod_id])) {
        
            $combined_subtotals[$orders_prod_id] += $orders_subtotal;
        } else {
        
            $combined_subtotals[$orders_prod_id] = $orders_subtotal;
        }
    
    
    
        $orders_id = $row["orders_id"];
        $order_transaction_code = $row["order_transaction_code"];
        $orders_nickname = $row["orders_nickname"];
        $orders_email = $row["orders_email"];
        $orders_contact = $row["orders_contact"];
        $orders_paymethod = $row["orders_paymethod"];
        $orders_qty = $row["orders_qty"];
        $db_qty = $row["qty"];
        $orders_voucher_rate = $row["orders_voucher_rate"];
        $orders_address = $row["orders_address"];
        $orders_date = $row["orders_date"];
        $orders_status = $row["orders_status"];
    
        $get_Product_info = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$orders_prod_id'");
        $product_row = mysqli_fetch_assoc($get_Product_info);
        $prod_name = $product_row["prod_name"];
        $prod_currprice = $product_row["prod_currprice"];
    
        ?>
        <tr>
            
                <td><?php echo $order_transaction_code ?></td>
            
    
            
            <input type="hidden" value="<?php echo $orders_id ?>" name="orders_id">
            <td>
            <?php
                    if ($orders_date !== null) {
                        // Kunin ang Unix timestamp ng oras
                        $timestamp = strtotime($orders_date);

                        // Idagdag ang 12 oras
                       

                        // I-format ang bagong oras
                        $dateTime = date("M j Y, g:ia", $timestamp);
                        echo $dateTime;
                    }
                    ?>

            </td>
    
            <td><?php echo $prod_name ?></td>
            <td><?php echo $orders_paymethod ?></td>
            
            <td>
                <?php 
                $get_product_record = mysqli_query($connections, "SELECT a.*, SUM(b.s_amount) AS prod_stocks
                FROM product AS a
                LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
                WHERE a.prod_id = '$orders_prod_id'
                GROUP BY a.prod_id");
            
            $per_row = mysqli_fetch_assoc($get_product_record);
            $db_prod_stocks = $per_row["prod_stocks"];
            $db_prod_name = $per_row["prod_name"];
                ?>
            <?php  
                echo $db_qty; 
            
            ?>
            </td>                  
            
            <td>
                <?php if($orders_status=="Decline" ||$orders_status== "Cancelled"){

                echo "<div class='text-danger'>".$orders_status."</div>";
                }else{
                
                 if($orders_status!='Invalid'){ echo $orders_status; }else{ echo "<div class='text-danger'>".$orders_status."</div>"; }
                 }?>
            </td>
            <?php if ($orders_status == "Preparing" || $orders_status == "In-Transit" || $orders_status == "Delivered") { ?>
                <td>
                
                <button type="button" class="btn btn-success" onclick="myFunction('<?php echo $order_transaction_code ?>')">View Orders</button>


                </td>

            <?php } else { ?>
                <td>
                <?php if($orders_status=="Decline" ||$orders_status== "Cancelled"||$orders_status== "Pending"){?>
                    <button type="button" class="btn btn-danger zz" value="<?= $orders_prod_id ?>"
                            data-value2="<?= $order_transaction_code ?>"
                            data-orders_status="<?= $orders_status ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            
                            <?php if($orders_status=="Decline" ||$orders_status== "Cancelled"){?>
                                Remove 
                            <?php }else{?>
                                Cancel
                            <?php ;}?>
                    </button>
                <?php }else if($orders_status=="Complete" ||$orders_status== "Invalid"){?>
                    

                    <button type="button" class="btn btn-danger toglertrash" value="<?= $orders_prod_id ?>"
                            data-value2="<?= $order_transaction_code ?>"
                            data-orders_status="<?= $orders_status ?>"
                            data-orders_id="<?= $orders_id ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modTrash">
                            
                            
                            <i style='font-size:15px' class='fas'>&#xf2ed;</i> 
                            
                    </button>
                    
                <?php } ?> 	
                    
                </td>
            <?php } ?>
        </tr>
        <?php
    } // end while
    
        ?>
        
        <?php
    }

    
?>

<script src='view/myOrder/js/function.js'></script>