--daily sales pos

SELECT DATE(orders_date) AS order_date, SUM(orders_subtotal) AS daily_total
FROM pos_orders
GROUP BY DATE(orders_date)
ORDER BY order_date;

--montly sales pos
SELECT YEAR(orders_date) AS order_year, MONTH(orders_date) AS order_month, SUM(orders_subtotal) AS monthly_total
FROM pos_orders
GROUP BY YEAR(orders_date), MONTH(orders_date)
ORDER BY order_year, order_month;

--yearly sales pos
SELECT YEAR(orders_date) AS order_year, SUM(orders_subtotal) AS yearly_total
FROM pos_orders
GROUP BY YEAR(orders_date)
ORDER BY order_year;

--daily sales online

SELECT DATE(order_date), SUM(total) AS daily_total
FROM new_tbl_orders
GROUP BY DATE(order_date)
ORDER BY order_date;

--montly sales online
SELECT YEAR(order_date) AS order_year, MONTH(order_date) AS order_month, SUM(total) AS monthly_total
FROM new_tbl_orders
GROUP BY YEAR(order_date), MONTH(order_date)
ORDER BY order_year, order_month;

--yearly sales pos
SELECT YEAR(order_date) AS order_year, SUM(total) AS yearly_total
FROM new_tbl_orders
GROUP BY YEAR(order_date)
ORDER BY order_year;