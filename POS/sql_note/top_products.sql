-- Top Product Online

SELECT product_id, prod_name, 
SUM(qty)as qty 
FROM `new_tbl_order_items` 
JOIN product ON product.prod_id = new_tbl_order_items.product_id 
GROUP BY product_id 
ORDER BY qty DESC 
LIMIT 5

-- Top Product Walkin

SELECT orders_prod_id, 
prod_name, 
SUM(orders_prodQty) as qty 
FROM pos_orders 
JOIN product ON product.prod_id = pos_orders.orders_prod_id 
GROUP BY orders_prod_id 
ORDER BY orders_prodQty DESC 
LIMIT 5