SELECT DATE(orders_date) AS order_date, SUM(orders_final) AS total_sales 
FROM pos_orders 
GROUP BY DATE(orders_date) 
ORDER BY DATE(orders_date) DESC 
LIMIT 10