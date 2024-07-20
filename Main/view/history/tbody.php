<?php 
$item_numer=0;
while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
 
        $orders_ship_fee = $row["orders_ship_fee"];
        $orders_orders_id = $row["orders_id"];
        $orders_tcode = $row["order_transaction_code"];
        $orders_prod_id = $row["orders_prod_id"];
    
        $orders_prodQty = $row["orders_qty"];
        $orders_voucher_rate = $row["orders_voucher_rate"];
        $orders_tax = $row["orders_tax"];
        $orders_date = $row["orders_date"];


        $refund_deadline = date("Y-m-d H:i:s", strtotime($orders_date . " + 7 days")); // Calculate the refund deadline

        $current_time = date("Y-m-d H:i:s"); // Get the current date and time
        
       

      
       
        $orders_user_id = $row["orders_customer_id"];
        $orders_status = $row["orders_status"];

        $totalprice = $row["totalprice"];
        //grp
        $order_id_grp = $row["order_id_grp"];
        $product_name_grp = $row["product_name_grp"];
        $order_qty_grp = $row["order_qty_grp"];
        $product_currprice_grp = $row["product_currprice_grp"];
    
               
        
       $get_account = mysqli_query ($connections,"SELECT * FROM account where acc_id='$orders_user_id' ");
       $accrow = mysqli_fetch_assoc($get_account);
        $db_acc_fname = $accrow["acc_fname"];
        $db_acc_lname = $accrow["acc_lname"];
        $fullname=$db_acc_fname." ".$db_acc_lname;


        $getprod = mysqli_query ($connections,"SELECT * FROM product where prod_id='$orders_prod_id' ");
        $prodrow = mysqli_fetch_assoc($getprod);
         $prod_name = $prodrow["prod_name"];
         $prod_currprice = $prodrow["prod_currprice"];

         $orders_date=date("M j Y, g:ia", strtotime($orders_date))

         

?>
  <tr>
    <td scope="row"><?php echo $orders_tcode?></td>
   
    <td><?php echo $orders_date?></td>
 
  
 

<td>
    <button class="form-control btn btn-success toglerView"
    data-bs-toggle="modal" data-bs-target="#ModalView"
    data-orders_orders_id="<?= $orders_orders_id ?>"
    data-orders_tcode="<?= $orders_tcode ?>"
    data-orders_prod_id="<?= $orders_prod_id ?>"
    data-orders_cart_id="<?= $orders_cart_id ?>"
    data-order_qty_grp="<?= $order_qty_grp ?>"
    data-product_name_grp="<?= $product_name_grp?>"
    data-totalprice="<?= $totalprice?>"
    data-product_currprice_grp="<?= $product_currprice_grp ?>"
    data-order_id_grp="<?= $order_id_grp?>"
    data-orders_voucher_rate="<?= $orders_voucher_rate?>"
    data-orders_ship_fee="<?= $orders_ship_fee?>"
  
    >
   
        
    <?php  $fullname?>

    
    View</button>
 
</td> 
  
  </tr>
  <?php  } 
?>