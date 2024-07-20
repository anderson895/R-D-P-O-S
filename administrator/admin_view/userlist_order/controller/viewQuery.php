<?php 
$view_query = mysqli_query($connections, "
			
SELECT
orders_id,
order_transaction_code,
orders_nickname,
orders_email,
orders_contact,
orders_paymethod,
orders_qty,
orders_prod_id,
SUM(orders_qty) AS qty,
SUM(orders_subtotal) AS subtotal,
orders_voucher_rate,
orders_address,
orders_date,
orders_status
FROM
orders
WHERE
display_status='0'
AND orders_customer_id = '".$db_acc_id."'
GROUP BY
orders_prod_id,
order_transaction_code
ORDER BY
orders_id ASC;

");
?>