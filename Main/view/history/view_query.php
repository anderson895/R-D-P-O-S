<?php 
 //$view_query = mysqli_query($connections,"SELECT * from pos_orders where orders_status='done' group by orders_tcode"); 
 $view_query = mysqli_query($connections, "SELECT *,
 GROUP_CONCAT(orders_prod_id SEPARATOR ', ') AS order_id_grp,
 GROUP_CONCAT(prod_name SEPARATOR ', ') AS product_name_grp,
 GROUP_CONCAT(orders_qty SEPARATOR ', ') AS order_qty_grp,
 GROUP_CONCAT(prod_currprice SEPARATOR ', ') AS product_currprice_grp,
 GROUP_CONCAT((prod_currprice*orders_qty) SEPARATOR ', ') AS totalprice
 FROM orders as a 
 LEFT JOIN product as b 
 ON a.orders_prod_id = b.prod_id
 where orders_status='Complete' AND orders_customer_id='$db_acc_id'
 GROUP BY order_transaction_code
 ORDER BY order_transaction_code DESC;"); // Order by transaction code from newest to oldest

?>