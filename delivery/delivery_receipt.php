<?php 

include("navigation.php");

$total_subtotal = 0; // Initialize the total_subtotal variable

$RDcode = $_GET["RDcode"];
$view_category_query = mysqli_query($connections, "SELECT * FROM orders WHERE order_transaction_code = '$RDcode'");
$order = mysqli_fetch_assoc($view_category_query);

  $db_orders_id = $order["orders_id"];
  $db_order_transaction_code  = $order["order_transaction_code"];
  $db_orders_date = $order["orders_date"];
  $db_orders_customer_id = $order["orders_customer_id"];
  

  $get_cashier = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_orders_customer_id' ");
  $crow = mysqli_fetch_assoc($get_cashier);
  $db_acc_fname = $crow["acc_fname"];
  $db_acc_lname = $crow["acc_lname"];   
 $fullname=$db_acc_fname." ".$db_acc_lname;       

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <title>Receipt</title>
</head>
<style>
    @media print {
      @page {
        size: 8.5in 11in; /* Adjust the size according to your bond paper dimensions */
        margin: 0; /* Remove default page margins */
      }

      body {
        margin: 1cm; /* Add a small margin to prevent content from touching the edge of the paper */
      }

      .print-button {
        display: none;
      }
    }
  </style>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header bg-dark text-white">
            <h4 class="text-center"><?php echo $db_system_name?></h4>
            <p class="text-center"><?php echo $db_system_address?></p>
          </div>
          <div class="card-body">
            <div class="row">
            <div class="col-md-6">
              <p><b>Transaction Code: </b><?php echo $db_order_transaction_code?></p>
            </div> 
            </div>

            <div class="row">
            <div class="col-md-6">
              <p><b>Transaction Date: </b><?php echo date("M j Y, g:ia", strtotime($db_orders_date))?></p>
            </div> 
            </div>
            
            <div class="row">
            <div class="col-md-6">
                <p><b>Customer name: </b><?php echo $fullname;?></p>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product Code</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $count =0;
               $view_category_query = mysqli_query($connections, "SELECT *
                FROM orders
                WHERE order_transaction_code = '$RDcode'");
               
               while ($order = mysqli_fetch_assoc($view_category_query)) {
                  //prod_code
                

                  $orders_id  = $order["orders_id"];
                  $order_transaction_code	 = $order["order_transaction_code"];
                  $orders_prod_id = $order["orders_prod_id"];
                  $orders_customer_id = $order["orders_customer_id"];
                  $orders_nickname = $order["orders_nickname"];
                  
//                  $discount_decimal=$db_orders_discount/100;

                  $orders_email= $order["orders_email"];
                  $orders_contact = $order["orders_contact"];
                  $orders_paymethod	 = $order["orders_paymethod"];
                  $orders_qty = $order["orders_qty"];
                  $db_orders_tax = $order["orders_tax"];

                  $orders_prod_price = $order["orders_prod_price"];

                  $orders_subtotal = $order["orders_subtotal"];

                  $orders_ship_fee = $order["orders_ship_fee"];

                  $orders_voucher_name = $order["orders_voucher_name"];

                  
                  $orders_voucher_rate = $order["orders_voucher_rate"];
                //  $voucher_percent=$orders_voucher_rate/100;
                  $voucher_percent = preg_replace('/[^0-9]/', '', $orders_voucher_rate);
                 if($voucher_percent){ 
                  $getdiscount = $voucher_percent /100;
                 }

                  
                  $orders_address = $order["orders_address"];
                  
                  $orders_date = $order["orders_date"];

           
                  $tax_percentage_formatted = number_format($db_orders_tax); // Format the percentage to 2 decimal places
                
                 
                
                  $get_order = mysqli_query($connections, "SELECT * FROM product WHERE prod_id = '$orders_prod_id' ");
                  $row = mysqli_fetch_assoc($get_order);
                  $db_prod_currprice = $row["prod_currprice"];
                  $db_prod_unit_id = $row["prod_unit_id"];     
                  $db_prod_name = $row["prod_name"];       
                  $db_orders_prod_code = $row["prod_code"];  


                  $get_cashier = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id = '$db_prod_unit_id' ");
                  $crow = mysqli_fetch_assoc($get_cashier);
                  $db_unit_name = $crow["unit_name"];

                  
                  

              
                  
                  $subtotal = $db_prod_currprice * $orders_qty;
                  $total_subtotal += $subtotal; // Add the subtotal to the total_subtotal variable
                  
                  $gettax=$db_orders_tax*$total_subtotal;
                    //$db_orders_discount
                 
                
                  
                 // $gettotal=($gettax+$total_subtotal)-$getdiscount;


                  $count ++;
                  ?>
                
                <tr>
                  <td><?php echo  $db_orders_prod_code ?></td>
                  <td> <?php echo $db_prod_name?></td>
                  <td> <?php echo $orders_qty?>&nbsp;<?php echo $db_unit_name?></td>
                  <td>&#8369; <?php echo number_format($db_prod_currprice, 2, '.', ',')?></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            <hr>
            Item Count : <?php echo  $count ?>
            <div class="row">
              <div class="col-md-6 offset-md-6">
                <table class="table table-bordered">
                  <tbody>
                    <!-- &#8369; <span id="subtot"><?php echo number_format($total, 2, '.', ',')?>-->
                    <tr>
                      <td>Subtotal</td>
                      <td>&#8369; <?php echo number_format($total_subtotal, 2, '.', ',')?></td>
                    </tr>
                    
                    <tr>
                      <td>VAT (<?php echo ($db_orders_tax*100)?>%)</td>
                      <td>&#8369; <?php echo number_format($gettax, 2, '.', ',')?></td>
                    </tr>

                    <tr>
                      <td>Shipping fee</td>
                      <td>&#8369; <?php echo number_format($orders_ship_fee,2)?></td>
                    </tr>
                    <?php
                    $total_subtotal=$total_subtotal+$gettax+$orders_ship_fee;
                    if($voucher_percent){ ?>
                    <tr>
                     
                    <td colspan="2"><?php echo $orders_voucher_name?></td>
                     
                    </tr>
                    <tr>
                      <td><?php echo $orders_voucher_rate?></td>
                      <td>&#8369; <?php echo number_format($voucher_value=$getdiscount*$total_subtotal,2)?></td>
                    </tr>
                    <tr>
                      <td>Total </td>
                      <td>&#8369; <?php echo number_format($total_subtotal-$voucher_value,2) ?></td>
                    </tr>
                    <?php }else{?>
                      <tr>
                      <td>Total </td>
                      <td>&#8369; <?php echo number_format($total_subtotal,2) ?></td>
                    </tr>
                      <?php }?>
                    

                   

                   
                  </tbody>
                </table>
              </div>
            </div>
            <p class="text-center">Thank you for purchasing :) </p>
          </div>
        </div>
        
        <button class="btn btn-primary mt-3 print-button" onclick="printReceipt()">Print Receipt</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function printReceipt() {
      window.print();
    }
  </script>
</body>

</html>
