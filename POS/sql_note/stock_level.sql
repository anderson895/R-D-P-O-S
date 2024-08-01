SELECT prod_name, prod_critical, prod_image, SUM(s_amount) AS total_amount
FROM stocks
JOIN product ON product.prod_id = stocks.s_prod_id
GROUP BY s_prod_id
ORDER BY total_amount ASC