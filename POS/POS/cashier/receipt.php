<?php 
include "../../connection.php";
include("navigation.php");

$total_subtotal = 0; // Initialize the total_subtotal variable

$RDcode = $_GET["RDcode"];
$view_category_query = mysqli_query($connections, "SELECT * FROM pos_orders WHERE orders_tcode = '$RDcode'");
$order = mysqli_fetch_assoc($view_category_query);

  $db_orders_orders_id  = $order["orders_orders_id"];
  $db_orders_tcode  = $order["orders_tcode"];
  $db_orders_date = $order["orders_date"];
  $db_orders_user_id = $order["orders_user_id"];
  

  $get_cashier = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_orders_user_id' ");
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
              <p><b>Transaction Code: </b><?php echo $db_orders_tcode?></p>
            </div> 
            </div>

            <div class="row">
            <div class="col-md-6">
              <p><b>Transaction Date: </b><?php echo date("M j Y, g:ia", strtotime($db_orders_date))?></p>
            </div> 
            </div>
            
            <div class="row">
            <div class="col-md-6">
                <p><b>Cashier: </b><?php echo $fullname;?></p>
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
                FROM pos_orders
                WHERE orders_tcode = '$RDcode'");
               
               while ($order = mysqli_fetch_assoc($view_category_query)) {
                  //prod_code
                

                  $db_orders_orders_id = $order["orders_orders_id"];
                  $db_orders_tcode = $order["orders_tcode"];
                  $db_orders_prod_id = $order["orders_prod_id"];
                  $db_orders_prodQty = $order["orders_prodQty"];
                  $db_orders_discount = $order["orders_discount"];
                  
                  $discount_decimal=$db_orders_discount/100;

                  $db_orders_date = $order["orders_date"];
                  $db_orders_final = $order["orders_final"];
                  $db_orders_payment = $order["orders_payment"];
                  $db_orders_user_id = $order["orders_user_id"];
                  $db_orders_tax = $order["orders_tax"];

                  $db_orders_change = $order["orders_change"];
                  
                  $tax_percentage = $db_orders_tax * 100;
                  $tax_percentage_formatted = number_format($tax_percentage); // Format the percentage to 2 decimal places
                
                 
                
                  $get_order = mysqli_query($connections, "SELECT * FROM product WHERE prod_id = '$db_orders_prod_id' ");
                  $row = mysqli_fetch_assoc($get_order);
                  $db_prod_currprice = $row["prod_currprice"];
                  $db_prod_unit_id = $row["prod_unit_id"];     
                  $db_prod_name = $row["prod_name"];       
                  $db_orders_prod_code = $row["prod_code"];  


                  $get_cashier = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id = '$db_prod_unit_id' ");
                  $crow = mysqli_fetch_assoc($get_cashier);
                  $db_unit_name = $crow["unit_name"];
                  

              
                  
                  $subtotal = $db_prod_currprice * $db_orders_prodQty;
                  $total_subtotal += $subtotal; // Add the subtotal to the total_subtotal variable
                  
                  $gettax=$db_orders_tax*$total_subtotal;
                    //$db_orders_discount
                 
                  $getdiscount=$discount_decimal*$total_subtotal;
                  
                  $gettotal=($gettax+$total_subtotal)-$getdiscount;
                  $count ++;
                  ?>
                
                <tr>
                  <td><?php echo  $db_orders_prod_code ?></td>
                  <td> <?php echo $db_prod_name?></td>
                  <td> <?php echo $db_orders_prodQty?>&nbsp;<?php echo $db_unit_name?></td>
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
                      <td>Total </td>
                      <td>&#8369; <?php echo number_format($gettotal, 2, '.', ',') ?></td>
                    </tr>

                    <tr>
                      <td>Discount (<?php echo $db_orders_discount?>%)</td>
                      <td>&#8369; <?php echo number_format($getdiscount, 2, '.', ',')?></td>
                    </tr>

                    <tr>
                      <td>Payment </td>
                      <td>&#8369; <?php echo number_format($db_orders_payment, 2, '.', ',') ?></td>
                    </tr>

                    <tr>
                      <td>Change </td>
                      <td>&#8369; <?php echo number_format($db_orders_change, 2, '.', ',') ?></td>
                    </tr>
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
