<?php 


include "navigation.php"; 
//include "../customer/backend/session.php"; 
//BtnProceedToDeliver
//confiem

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


</head>
<style>
        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    <script>

$(document).ready(function () {
    $('#example').DataTable();
});
</script>
<body>

<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Center the row -->
        <div class="col-15">
            <div class="container-fluid d-flex justify-content-center mb-2">
                <div class="card w-100">
                    <div class="card-body">
                      <center>  <h5 class="card-title" style="text-align: center;"><h1>HISTORY OF ORDERS</h1></center>
                        <div class="container">
                    
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                 
                                        <th scope="col">Order No</th>         
                                        <th scope="col">Transaction Code</th>                                 
                                        <th scope="col">Order Date</th>
                                       
                                        <th scope="col">Mode of payment</th>
                                        <th scope="col">Address</th>
                                      
                                      
                                        <th scope="col">Status</th>
                                    
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php                           
            $view_query = mysqli_query($connections, "SELECT *,
            GROUP_CONCAT(orders_prod_id SEPARATOR ', ') AS order_id_grp,
            GROUP_CONCAT(orders_address SEPARATOR ', ') AS orders_addresGroup,
             GROUP_CONCAT(prod_name SEPARATOR ', ') AS product_name_grp,
            GROUP_CONCAT(orders_qty SEPARATOR ', ') AS order_qty_grp,
            GROUP_CONCAT(prod_currprice SEPARATOR ', ') AS product_currprice_grp,
            GROUP_CONCAT((prod_currprice*orders_qty) SEPARATOR ', ') AS totalprice
            FROM orders as a 
            LEFT JOIN product as b 
            ON a.orders_prod_id = b.prod_id
             WHERE orders_status ='Complete' OR orders_status ='Not Delivered'
             GROUP BY order_transaction_code;");
                                    
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                        
                                            
                                      $orders_prod_id = $row["orders_prod_id"];
                                      $orders_customer_id = $row["orders_customer_id"];
                                      $orders_nickname = $row["orders_nickname"];
                                      $orders_email = $row["orders_email"];
                                      $orders_contact = $row["orders_contact"];

                                     
                                      $orders_paymethod = $row["orders_paymethod"];
                                      $orders_subtotal = $row["orders_subtotal"];
                                      $orders_address = $row["orders_address"];

                                          

                                      $order_id_grp = $row["order_id_grp"];
                                      $product_name_grp = $row["product_name_grp"];
                                      $order_qty_grp = $row["order_qty_grp"];
                                      $product_currprice_grp = $row["product_currprice_grp"];
                                      $totalprice = $row["totalprice"];
                                     
                                      $db_orders_date = $row["orders_date"];
                                      $orders_date =date("M j Y, g:ia", strtotime($db_orders_date ));

                                      $orders_status = $row["orders_status"];
                                      $order_transaction_code = $row["order_transaction_code"];
                                      $orders_qty = $row["orders_qty"];

                                      $orders_voucher_name = $row["orders_voucher_name"];
                                      $orders_voucher_rate = $row["orders_voucher_rate"];

                                    
                                      $orders_voucher_rate_cleaned = preg_replace('/[^0-9.]/', '', $orders_voucher_rate);
                                      if($orders_voucher_rate_cleaned){
                                      $orders_voucher_rate_percent = $orders_voucher_rate_cleaned / 100;
                                      }

                                      $item_numer++;       
                                      
                                      $get_accountrecord = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$orders_customer_id' ");
                                      $row = mysqli_fetch_assoc($get_accountrecord);
                                      $acc_fname=$row["acc_fname"];
                                      $acc_lname=$row["acc_lname"];
                                      $customer_fullname=$acc_fname." ".$acc_lname;
                                      
                              
                                      $get_productrecord = mysqli_query ($connections,"SELECT * FROM product where prod_id  ='$orders_prod_id' ");
                                      $row = mysqli_fetch_assoc($get_productrecord);
                                      $prod_name=$row["prod_name"];
                                      $prod_unit_id=$row["prod_unit_id"];
                                      $prod_category_id=$row["prod_category_id"];
                                      $prod_image=$row["prod_image"];
                                      $prod_currprice=$row["prod_currprice"]
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo $item_numer?></td>
                                        <td scope="row"><?php 
                                        if($orders_status=="Preparing"){
                                            echo "N/A";
                                        }else{
                                            echo $order_transaction_code;
                                        }
                                        
                                        ?></td>
                                        <td><?php echo $orders_date?></td>
                                       
                                        <td><?php echo  $orders_paymethod?>&nbsp;
                                        
                                        
<script>
function backTo() {
window.location.href = "addstocks.php";
}
</script>
                                    
                                    </td>
                                    <td><?php echo $orders_address?></td>
                                   
                                      
                                        
                                        <td><?php if($orders_status=="Complete"){ echo "<b style='color:green;'>".$orders_status."</b>";}else if($orders_status=="Not Delivered"){ echo "<b style='color:red;'>".$orders_status."</b>";}?></td>
                                        <td>
                                         
                                        <div class="container text-center">
    <div class="row align-items-start">
    <div class="container">
                                        <!--START BUTTON
                                    $prod_name/orders_qty/prod_currprice//orders_nickname
                                    -->
                                    <button type="button" 
                                          class="btn btn-primary togler w-26" 
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModal"
                                          data-id="<?=$orders_prod_id?>"
                                          data-transaction="<?=$order_transaction_code?>"
                                          data-orders_address="<?=$orders_address?>"
                                          data-orders_prod_id="<?=$orders_prod_id?>"
                                          data-customer_fullname="<?=$customer_fullname?>"
                                          data-prod_name="<?=$prod_name?>"
                                          data-orders_qty="<?=$orders_qty?>"
                                          data-prod_currprice="<?=$prod_currprice?>"
                                          data-prod_nem="<?=$product_name_grp?>"
                                          data-product_name_grp="<?=$product_name_grp?>"
                                          data-product_currprice_grp="<?=$product_currprice_grp?>"
                                          data-order_qty_grp ="<?=$order_qty_grp?>"
                                          data-order_id_grp ="<?=$order_id_grp?>"
                                          data-totalprice ="<?=$totalprice?>"
                                          data-orders_nickname ="<?=$orders_nickname?>"
                                          data-orders_voucher_name ="<?=$orders_voucher_name?>"
                                          data-orders_voucher_rate_percent ="<?=$orders_voucher_rate_percent?>"
                                          data-orders_date="<?= $orders_date?>"
                                          data-orders_email ="<?=$orders_email?>"
                                          data-orders_contact="<?= $orders_contact?>" 
                                          data-orders_paymethod="<?= $orders_paymethod?>" 
                                          data-orders_voucher_rate_cleaned="<?= $orders_voucher_rate_cleaned?>" 
                                          data-orders_status="<?= $orders_status?>" 
                                           >
                                                          
                                              View
                                          </button>
                                         
                                      </div>

                                      <?php if($orders_status=="Preparing"){ ?> 
                                      <div class="container">
                                   
                                        <button type="button" class="btn btn-success tugle"  data-bs-toggle="modal" data-bs-target="#exampleModal1" 
                                        data-transaction="<?=$order_transaction_code?>"
                                        data-productId="<?=$order_id_grp?>"
                                        data-orders_qty="<?=$order_qty_grp?>"
                                        >
                                            Deliver
                                        </button>
                                      
                                        <div class="container">
                                      <button type="button" class="btn btn-danger tugleCancel" data-bs-toggle="modal" data-bs-target="#exampleModa2"
                                        data-transaction="<?=$order_transaction_code?>"
                                       
                                      >
                                          Cancel
                                      </button>     
                                    </div>
                                    </div>
                                    <?php } ?>

                                    <?php if($orders_status=="In-Transit"){ ?> 
                                      <div class="container">
                                   
                                        <button type="button" class="btn btn-success tugleDelivered"  data-bs-toggle="modal" data-bs-target="#exampleModal3" 
                                        data-transaction="<?=$order_transaction_code?>"
                                        data-productId="<?=$orders_prod_id?>"
                                        data-$orders_qty="<?=$$orders_qty?>"


                                        >
                                        Delivered
                                         
                                        </button>
                                      
                                    </div>
                                    <?php } ?>

                                    <!---Archive--->
                                    <?php if($orders_status=="Delivered"){ ?> 
                                      <div class="container">             
                                        <button type="button" class="btn btn-success tugleArchive"  data-bs-toggle="modal" data-bs-target="#exampleModal4" 
                                        data-transaction="<?=$order_transaction_code?>"
                                        >
                                            Archive
                                        </button>
                                      
                                    </div>
                                    <?php } ?>
                               
</div>   

                                        </td>
                                      </tr>
                                      <?php  } ?>
                                    </tbody>
                                    
                                  </table>
                                
                                  </div>
                                  
                    </div>
                    


                
    <!--VIEW ORDERS-->
    <!--VIEW ORDERS-->
   
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                        <h1 id="customer_nameDisplay"></h1>
                                                      <div class="container">
                                                          <div class="row">
                                                          
                                                              <div class="col">

                                                              
                                                                  <div class="container">
                                                             
                                                                      <h1 id="customer_fullname"></h1>
                                                                      <h2>( <i id="orders_nickname"></i> )</h2>

                                                                      <div class="container-fluid mb-3">
                                                                          
                                                                      </div>
                                                                  </div>
                                                              </div> 
                                                              <div class="col">
                                                                  <div class="container d-flex justify-content-end">
                                                                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">BACK</button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="table-responsive">
                                                              <table class="table">
                                                                  <thead>
                                                                      <tr>
                                                                      <th scope="col"> Fullname</th>
                                                                      <th scope="col"> Nickname</th>
                                                                        <th scope="col">Order Date</th>
                                                                        <th scope="col">Orders Email</th>
                                                                        <th scope="col">Orders Contact</th>
                                                                        <th scope="col">Payment Method</th>
                                                                        <th scope="col">Address</th>
                                                                        <th scope="col">Status</th>
                                                                        
                                                                      
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody id="tbody">
                                                                      
                                                                    </tbody>
                                                              </table>
                                                          </div>
                                                          <div class="container">
                                                              <div class="row">
                                                                  <div class="col">
                                                                      <div class="container">
                                                                          
                                                                      </div>
                                                                  </div>
                                                                  <div class="col">
                                                                      <div class="container d-flex justify-content-end">
                                                                          <div class="card" style="width: 25rem;">
                                                                              <div class="card-body">
                                                                                <div class="container">
                                                                                  <div class="row">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Subtotal:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" id="subtowtal">₱ 1,000.00</p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">VAT</p>
                                                                                              (<p class="card-text" ><span id="subtax"></span>%</p>) :
                                                                                          </div>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="subtaxTotal"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Shipping fee:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="shipfee"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                
                                                                                  <div class="row mb-2" id='voucherRow'>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Voucher:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="orders_voucher_name"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                             
                                                                                  
                                        <!--//$orders_voucher_name-->
                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                          Total order:&nbsp; <span id="totalDue"> </span>
                                                                                      </div>
                                                                                 
                                                                                  </div>
                                                                                </div>


                                                                                <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                      <button class="form-control btn btn-secondary" onclick="redirectToReceiptPage()">PRINT RECEIPT</button>
                                                                                            <span id="transactionDisplay" hidden></span>

                                                                                            <script>
                                                                                              function redirectToReceiptPage() {
                                                                                                var transactionDisplay = document.getElementById('transactionDisplay').innerHTML;
                                                                                                var url = 'delivery_receipt.php?RDcode=' + encodeURIComponent(transactionDisplay);
                                                                                                window.location.href = url;
                                                                                              }
                                                                                            </script>

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

                                          <!--DELIVER--->
                                          <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                  <div class="container">
                                                    <div class="container mb-3" style="text-align: center;">
                                                        ARE YOU SURE YOU<br>
                                                        WANT TO PROCCED<br>
                                                        TO DELIVER ?
                                                    </div>
                                                    
                                                    <form action="proceedDeliver.php" method="POST">
                                                    <input type="text" id="transactionDeliver" hidden name="transactionId">
                                                    <input type="text" id="productId" hidden  name="productId">
                                                    <input type="text" id="qty" hidden  name="qty">
                                             
                                                    <div class="container d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">NO</button>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="submit" name="confiem" class="btn btn-success">YES</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>


                                     <!--DELIVERED--->
                                     <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                  <div class="container">
                                                    <div class="container mb-3" style="text-align: center;">
                                                          ARE YOU SURE <br>
                                                        THE ORDER WAS DELIVERED ?
                                                    </div>

                                                    <form action="proceedDeliver.php" method="POST">
                                                    <input type="text" id="transactionDelivered" hidden name="transactionId">
                                                    <div class="container d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">NO</button>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="submit" name="confirmDeliver" class="btn btn-success">YES</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>



                                     <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                  <div class="container">
                                                    <div class="container mb-3" style="text-align: center;">
                                                          ARE YOU SURE <br>
                                                        THE ORDER RECORD MOVE TO ARCHIVE ?
                                                    </div>

                                                    <form action="proceedDeliver.php" method="POST">
                                                    <input type="text" id="transactionArchive" hidden name="transactionId">
                                                    <div class="container d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">NO</button>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="submit" name="btnArchive" class="btn btn-success">YES</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

                                        <!---cancel--->
                                        
                                         
                                            <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                                    <div class="container">
                                                    <form action="proceedDeliver.php" method="POST">
                                                    <input type="text" id="transactionCancel" name="transactionId">
                                                      <div class="container mb-3" style="text-align: center;">
                                                          ARE YOU SURE YOU<br>
                                                          WANT TO CANCEL<br>
                                                          ORDERS
                                                      </div>
                                                      <div class="container d-flex justify-content-center">
                                                          <div class="row">
                                                              <div class="col">
                                                                  <div class="container">
                                                                      <button type="button" data-bs-dismiss="modal"  class="btn btn-danger">NO</button>
                                                                  </div>
                                                              </div>
                                                              <div class="col">
                                                                  <div class="container">
                                                                      <button type="submit" class="btn btn-success" name="btnCancel">YES</button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                     
 </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
<script>
     /**
      * 
      * // data-customer_fullname
    $('.tugle').click(function(){
        var transaction = $(this).attr('data-transaction')
        var productId = $(this).attr('data-productId')
        var qty=$(this).attr('data-orders_qty')
        $('#transactionDeliver').val(transaction)
        $('#productId').val(productId)
        $('#qty').val(qty)
      */
     //data-productId
     // //data-orders_nickname
     $('.togler').click(function(){

      //orders_status

      var orders_status = $(this).attr('data-orders_status');

    var orders_prod_id = $(this).attr('data-orders_prod_id');

    var transaction = $(this).attr('data-transaction');
    var orders_date = $(this).attr('data-orders_date');
    var orders_qty = $(this).attr('data-orders_qty');
    var customer_fullname = $(this).attr('data-customer_fullname');     
    var orders_nickname = $(this).attr('data-orders_nickname'); 
    
    var orders_date = $(this).attr('data-orders_date'); 
    var orders_email = $(this).attr('data-orders_email'); 
    var orders_contact = $(this).attr('data-orders_contact'); 
    
    var prod_name = $(this).attr('data-prod_name');
    var prod_currprice = $(this).attr('data-prod_currprice');
    var orders_subtotal = $(this).attr('data-orders_subtotal');

    var orders_voucher_name = $(this).attr('data-orders_voucher_name');
    var orders_voucher_rate_percent = $(this).attr('data-orders_voucher_rate_percent');
    var orders_voucher_rate_cleaned = $(this).attr('data-orders_voucher_rate_cleaned');
    var orders_paymethod = $(this).attr('data-orders_paymethod');
    var orders_address = $(this).attr('data-orders_address');
    
      //orders_address
      
      
   

    var prod_nem = $(this).attr('data-prod_nem');
    var product_name_grp = $(this).attr('data-product_name_grp');
    var order_qty_grp = $(this).attr('data-order_qty_grp');
    var product_currprice_grp = $(this).attr('data-product_currprice_grp');
    var order_id_grp = $(this).attr('data-order_id_grp');
    var totalprice = $(this).attr('data-totalprice');  
    var tbody = $('#tbody');
    
    
    $('#orders_date').text(orders_date)

 
    $('#transactionDisplay').text(transaction)
    $('#customer_fullname').val(customer_fullname)
    $('#customer_nameDisplay').text(customer_fullname)
    $('#orders_nickname').text(orders_nickname)
    tbody.empty(); // Ito ang karagdagang bahagi para burahin ang mga dati at i-reset ang tbody.


    var prodname = prod_nem.split(',');
    var product_name_grp = product_name_grp.split(',');
    var order_qty_grp = order_qty_grp.split(',');
    var product_currprice_grp = product_currprice_grp.split(',');
    var order_id_grp = order_id_grp.split(',');
    var totalprice = totalprice.split(',');

    var total = 0;
    var tr = $("<tr>");
       


        var td = $("<td>").text(customer_fullname);
        tr.append(td);
        var td = $("<td>").text(orders_nickname);
        tr.append(td);
        var td = $("<td>").text(orders_date);
        tr.append(td);
        var td = $("<td>").text(orders_email);
        tr.append(td);
        var td = $("<td>").text(orders_contact);
        tr.append(td);
        var td = $("<td>").text(orders_paymethod);
        tr.append(td);
        var td = $("<td>").text(orders_address);
        tr.append(td);
        var td = $("<td>");
        if (orders_status == "Complete") {
          td.text(orders_status).css("color", "green");
        } else if (orders_status == "Not Delivered") {
          td.text(orders_status).css("color", "red");
        } else {
          td.text(orders_status); // Handle other cases without color styling
        }
       
        tr.append(td);
    prodname.forEach((product,index) => {
        
       
        tbody.append(tr);
        total += parseFloat(totalprice[index]);
    });
  
    //var voucher_status = $(this).attr('data-voucher_status');
    var shipfee = parseFloat(<?php echo json_encode($db_system_shipfee);?>);

    var tax = parseFloat(<?php echo json_encode($db_system_tax);?>);
    var taxPercent = tax * 100;
    var subtax = tax * total;

    
    
    $("#orders_voucher_name").text(orders_voucher_name);

    $("#shipfee").text(shipfee.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));

    $("#subtowtal").text(total.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
    $("#subtax").text(taxPercent);
    $("#subtaxTotal").text(subtax.toFixed(2));
   
    minushipfee=total+subtax+shipfee;
    
  
    if(orders_voucher_rate_cleaned){
    var get_final_discount=orders_voucher_rate_percent*minushipfee;
    var totalDue=minushipfee-get_final_discount;
      $("#voucherRow").show()
    }else{

     
        $("#voucherRow").hide()//hiden id='voucherRow' when the orders_voucher_rate_cleaned is null

    var totalDue=minushipfee;
      
    }
    $("#totalDue").text(totalDue.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
  
    console.log(orders_voucher_rate_cleaned)

   

});
/**
 * 
 * 
 * 
  
 */
       
</script>

<script>


      $('.tugleCancel').click(function(){
              var transaction = $(this).attr('data-transaction')
              var productId = $(this).attr('data-productId')
              var qty=$(this).attr('data-orders_qty')
              $('#transactionCancel').val(transaction)
              $('#productId').val(productId)
              $('#qty').val(qty)
          })
    // data-customer_fullname
 

    $('.tugle').click(function(){
        var transaction = $(this).attr('data-transaction')
        var productId = $(this).attr('data-productId')
        var qty=$(this).attr('data-orders_qty')
        $('#transactionDeliver').val(transaction)
        $('#productId').val(productId)
        $('#qty').val(qty)
    })



    $('.tugleDelivered').click(function(){
        var transaction = $(this).attr('data-transaction')
        $('#transactionDelivered').val(transaction)
    })

    $('.tugleArchive').click(function(){
        var transaction = $(this).attr('data-transaction')
        $('#transactionArchive').val(transaction)
    })

    

    
</script>


<!-- Script for auto update specific div -->
<script>
  $(document).ready(function() {
    var counter = 9;
    window.setInterval(function() {
      counter = counter - 3;
      if (counter >= 0) {
        document.getElementById('off').innerHTML = counter;
      }
      if (counter === 0) {
        counter = 9;
      }
      $("#here").load(window.location.href + " #here");
    }, 3000);
  });
</script>