SELECT DATE(order_date) as order_date, SUM(total) as total_sales 
FROM `new_tbl_orders` 
GROUP BY DATE(order_date) 
ORDER BY DATE(order_date) ASC 
LIMIT 10