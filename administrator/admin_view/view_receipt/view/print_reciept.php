<?php
//include('../config/config.php');
include('backend/back_navbar.php');

if (isset($_GET['view_id'])) {
    $transaction_code = $_GET['view_id'];

    $get_record = mysqli_query ($connections,"SELECT * FROM orders where order_transaction_code='$transaction_code' ");
	$row = mysqli_fetch_assoc($get_record);
    $db_orders_date = $row["orders_date"];
    $db_orders_dates_delivered = $row["orders_dates_delivered"];

} else {
    header("location: list_order.php");
}
?>

    <div class="navigations">    

    </div>

    <br><br><br>
    <div class="receipt shadow">
        <div class="receipt-header">
            <h2 class="mt-3 fw-bold"><?=$db_system_name?></h2>
            
            <p class="text-center m-0">R De Leon Poultry Supplies</p>
            <p class="text-center m-0">Date: <?=$db_orders_date?></p>
            <p class="text-center m-0">Contact: <?=$db_system_contact?></p>
            <p class="text-center m-0">Address: <?=$db_system_address?></p>
            <p class="text-center m-0">Transaction Code: <?= $transaction_code?></p>
        </div>

        <hr>
        <div class="receipt-content">
            <div  class="div-scroll">
                <table class=" w-100">
                    <thead>
                        <th width="60%" >Item</th>
                        <th width="20%" >Price</th>
                        <th width="10%" class="text-end">Qty</th>
                    </thead>
                
                    <tbody>
                        <?php 
                       
                       $view_query = mysqli_query($connections, " SELECT *, SUM(orders.orders_subtotal) as grand_total
                        FROM orders
                        LEFT JOIN product ON orders.orders_prod_id = product.prod_id
                        WHERE orders.order_transaction_code='$transaction_code'
                        GROUP BY orders.orders_prod_id
                    ");

                       
                        $totalDiscount=0;
                        $subtotalAll=0;
                        while($row = mysqli_fetch_assoc($view_query)){
                            $orders_nickname = $row["orders_nickname"];
                            $db_orders_email = $row["orders_email"];
                            $db_orders_contact = $row["orders_contact"];
                            
                            $db_orders_paymethod = $row["orders_paymethod"];
                            $db_orders_qty = $row["orders_qty"];
                            $db_orders_prod_price = $row["orders_prod_price"];
                            $db_orders_subtotal = $row["orders_subtotal"];
                            $db_orders_ship_fee = $row["orders_ship_fee"];
                            $db_orders_tax = $row["orders_tax"];
                            
                            $db_orders_voucher_name = $row["orders_voucher_name"];
                            $db_orders_voucher_rate = $row["orders_voucher_rate"]/100;
                          
                            
                            $db_orders_date = $row["orders_date"];
                            $db_order_barcode = $row["order_barcode"];

                            $db_prod_name = $row["prod_name"];

                            $grand_total = $row["grand_total"];
                            $discountEach=$db_orders_prod_price*$db_orders_voucher_rate;

                            $subtotal= $db_orders_prod_price-$discountEach;


                            $totalDiscount +=$discountEach;
                            $subtotalAll +=$subtotal*$db_orders_qty;
                            

                            echo '
                            <tr >
                            <td class="pt-1">' . (strlen($db_prod_name) > 20 ? substr($db_prod_name, 0, 30) . '...' : $db_prod_name) . '</td>
                            <td class="text-end pt-1">' .$subtotal . '</td>
                            <td class="text-end pt-1">' . $db_orders_qty . '</td>
                            </tr>
                            ';
                        }
                        
                        ?>
                    </tbody>
                </table>
                </div>
                
            </div>
        <hr>

        <table width="100%">
            <tbody>
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-end"> <?= $subtotalAll?></td>
                </tr>
               
                <tr>
                    <td>VAT:</td>
                    <td class="text-end"> <?php echo $db_orders_tax?></td>
                </tr>

                <tr>
                    <td>Shipping fee:</td>
                    <td class="text-end"><?=$db_orders_ship_fee?></td>
                </tr>
                
                
                <tr >
                    <td>Total:</td>
                    <td class="text-end"> <?= $subtotalAll+$db_orders_ship_fee?></td>
                </tr>
                
                
                <tr >
                    <td>Payment:</td>
                    <td class="text-end"> <?= $db_orders_paymethod?></td>
                </tr>
                
            </tbody>

            
        </table>
        <hr>
        <img src="../../upload_barcode/<?= $db_order_barcode?>" alt="">
        <p class="text-center mb-2">Thanks for shopping :)</p>
        <div class="d-flex justify-content-center mb-3">
            <button id="printButton" class="btn btn-sm btn-primary w-100" >Print</button>
            
        </div>
        
    </div>
    

<script>
    document.getElementById("printButton").addEventListener("click", function() {
        window.print();
    });
</script>


