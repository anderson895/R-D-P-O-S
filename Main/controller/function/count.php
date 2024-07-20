<?php 

$sql = mysqli_query($connections, "
SELECT COUNT(DISTINCT a.cart_prod_id) AS count_rows, SUM(a.cart_prodQty) AS qtys 
FROM cart AS a  
WHERE a.cart_user_id='{$_SESSION['acc_id']}'
");
$row = mysqli_fetch_assoc($sql);
$count = $row['count_rows'];
$items = $row['qtys'];

?>