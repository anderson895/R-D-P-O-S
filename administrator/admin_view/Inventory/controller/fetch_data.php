<?php
// fetch_data.php

// Include your database connection file
include("../.../../../../../connection.php");

$current_date = date("Y-m-d");

$query = "
    SELECT *,
        SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', s.s_amount, 0)) AS prod_stocks
    FROM product AS p
    LEFT JOIN stocks AS s ON p.prod_id = s.s_prod_id
    LEFT JOIN category AS c ON p.prod_category_id = c.category_id
    WHERE (prod_status = '0' OR prod_status = '1') AND s.s_amount != '0' AND s_status='1'
    GROUP BY p.prod_id
    ORDER BY `prod_added` DESC
";

$result = mysqli_query($connections, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);

mysqli_close($connections);
?>
