<?php 

$db_order_transaction_code=""; 
$get_orderrecord = mysqli_query ($connections,"SELECT * FROM orders where orders_customer_id='".$db_acc_id."' && display_status='0' Group by order_transaction_code ");
$row = mysqli_fetch_assoc($get_orderrecord);
?>