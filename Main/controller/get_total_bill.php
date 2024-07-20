<?php 

$connections = mysqli_connect("localhost", "root", "", "u722452653_rdpos");
//$connections = mysqli_connect ("localhost","u722452653_rdpos","Rdpos12345678","u722452653_rdpos");
// Start the session
session_start();

$total_bill = 0;
$total_prices = []; // Initialize an array to store all total_price values

$view_product_query = mysqli_query($connections, "SELECT *, SUM(a.cart_prodQty) as qty 
        FROM cart as a 
        LEFT JOIN product as b ON a.cart_prod_id = b.prod_id
        WHERE a.cart_user_id='{$_SESSION['acc_id']}'
        GROUP BY a.cart_prod_id");
while ($product_row = mysqli_fetch_assoc($view_product_query)) {
    $db_cart_id = $product_row["cart_id"];    
    $db_prod_id = $product_row["prod_id"]; 

    $current_date = date("Y-m-d"); // Get the current date
    $view_query = mysqli_query($connections, "
        SELECT *,
            SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
        FROM product AS a
        LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
        WHERE prod_status = '0' AND s_prod_id='$db_prod_id' 
        GROUP BY a.prod_id
    ");
    $row = mysqli_fetch_assoc($view_query);
    $stocks = $row["s_amount"];
    $prod_stocks = $row["prod_stocks"];

    $db_prod_name = $product_row["prod_name"];
    $db_prod_orgprice = $product_row["prod_orgprice"];
    $db_prod_currprice = $product_row["prod_currprice"];

    $db_qty = $product_row["qty"];

    $total_price = $db_prod_currprice * min($db_qty, $prod_stocks); // Calculate total price for the product
    $total_bill += $total_price; // Add the total price to the total bill

    // Add the total_price to the array
    $total_prices[] = $total_price;
}

header('Content-Type: application/json');
echo json_encode(['total_bill' => $total_bill, 'total_prices' => $total_prices]);
?>
