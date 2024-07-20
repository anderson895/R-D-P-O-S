<div id="posDiv" class="container-fluid" style="display: none;">
        <div class="row justify-content-center">
            <div class="col-15">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title" style="text-align: center;">
                                    <h1>LIST OF TRANSACTION<br>IN POINT OF SALE</h1><br>
                                    <i>The customer has only 7 days after purchasing the item to request a return or refund</i>
                                </h5>
                            </center>
                            <br>
                            <div class="container">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-10" style="width: 100%;">
                                            <div class="container-fluid d-flex justify-content-center mb-2">
                                                <div class="card w-100">
                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="table-responsive">
                                                                <table id="example" class="table">
                                                                <thead>
                                      <tr>
                                        <th scope="col" style='width:10;'>No.</th>
                                        <th scope="col">Transaction&nbsp;code</th>
                                        <th scope="col">Transaction Date</th>
                                        <th scope="col">Cashier</th>
                                       
                                        <th scope="col">Status</th>       
                                        <th scope="col">Action</th>    
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php  
                           $view_query = mysqli_query($connections, "SELECT *,
                            GROUP_CONCAT(orders_prod_id SEPARATOR ', ') AS order_id_grp,
                            GROUP_CONCAT(prod_name SEPARATOR ', ') AS product_name_grp,
                            GROUP_CONCAT(orders_prodQty SEPARATOR ', ') AS order_qty_grp,
                            GROUP_CONCAT(prod_currprice SEPARATOR ', ') AS product_currprice_grp,
                            GROUP_CONCAT((prod_currprice*orders_prodQty) SEPARATOR ', ') AS totalprice
                            FROM pos_orders as a 
                            LEFT JOIN product as b 
                            ON a.orders_prod_id = b.prod_id
                            where orders_status='done'
                            GROUP BY orders_tcode;");
                                 
                                 
                                 $item_number = 0;
                                 while ($row = mysqli_fetch_assoc($view_query)) {
                                     $orders_orders_id = $row["orders_orders_id"];
                                     $orders_tcode = $row["orders_tcode"];
                                     $orders_prod_id = $row["orders_prod_id"];
                                     $orders_cart_id = $row["orders_cart_id"];
                                     $orders_prodQty = $row["orders_prodQty"];
                                     $orders_discount = $row["orders_discount"];
                                     $orders_tax = $row["orders_tax"];
                                     $orders_date = $row["orders_date"];
                                     $orders_final = $row["orders_final"];
                                     $orders_payment = $row["orders_payment"];
                                     $orders_change = $row["orders_change"];
                                     $orders_user_id = $row["orders_user_id"];
                                     $orders_status = $row["orders_status"];
                                 
                                     $totalprice = $row["totalprice"];
                                     //grp
                                     $order_id_grp = $row["order_id_grp"];
                                     $product_name_grp = $row["product_name_grp"];
                                     $order_qty_grp = $row["order_qty_grp"];
                                     $product_currprice_grp = $row["product_currprice_grp"];
                                 
                                     $get_account = mysqli_query($connections, "SELECT * FROM account WHERE acc_id='$orders_user_id'");
                                     $accrow = mysqli_fetch_assoc($get_account);
                                     $db_acc_fname = $accrow["acc_fname"];
                                     $db_acc_lname = $accrow["acc_lname"];
                                     $fullname = $db_acc_fname . " " . $db_acc_lname;
                                 
                                     $getprod = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$orders_prod_id'");
                                     $prodrow = mysqli_fetch_assoc($getprod);
                                     $prod_name = $prodrow["prod_name"];
                                     $prod_currprice = $prodrow["prod_currprice"];
                                 
                                     $orders_date = date("M j Y, g:ia", strtotime($orders_date));

                                     $refund_deadline = date("Y-m-d H:i:s", strtotime($orders_date . " + 7 days")); // Calculate the refund deadline

                                     $current_time = date("Y-m-d H:i:s"); // Get the current date and time
                                     
                                     if ($current_time <= $refund_deadline) {
                                         // Customer is still within the 7-day refund window
                                         $status= "<b style='color:green;'>You can request a return or refund.</b>";
                                     } else {
                                         // Refund window has expired
                                         $status= "<b style='color:red;'>The refund window has expired.</b>";
                                     }
                                    $item_number++;
                                 
                                 ?>
                                 
                                    
                                      <tr>
                                        <td scope="row"><?php echo $item_number?></td>
                                        <td ><?php echo $orders_tcode?></td>
                                       
                                        <td><?php echo $orders_date?></td>
                                        <td><?php echo  $fullname?></td>
                                  
                                        <td><?php echo $status ?></td>
                                 
                                    <td>
                                        <button onclick="redirectToDirectory('<?php echo $orders_tcode ?>')" class="form-control btn btn-success "
                                         >  View</button>   
                                    </td> 
                                      
                                      </tr>
                                      <?php  } ?>
                                    </tbody>  
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>