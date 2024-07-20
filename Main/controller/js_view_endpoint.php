<?php 
include("../../connection.php"); // Adjust the path as needed

// Get parameters from the AJAX request
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 8;
$current_date = isset($_GET['current_date']) ? $_GET['current_date'] : date("Y-m-d");

// Calculate offset
$offset = ($page - 1) * $limit;

// Fetch products from the database
$query = "SELECT *,
            SUM(IF(s_expiration = '0000-00-00' OR s_expiration > '$current_date', b.s_amount, 0)) AS prod_stocks
            FROM product AS a
            LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
            WHERE prod_status = '0' 
            GROUP BY a.prod_id
            LIMIT $limit OFFSET $offset";

$result = mysqli_query($connections, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($connections));
}

// Create an array to store the products
$dataArray = [];

while ($product_row = mysqli_fetch_assoc($result)) {
    // Process each product and add it to the array
    $productData = [
        'prod_id' => $product_row['prod_id'],
        'prod_name' => $product_row['prod_name'],
        'prod_orgprice' => $product_row['prod_orgprice'],
        'prod_currprice' => $product_row['prod_currprice'],
        'prod_stocks' => $product_row['prod_stocks'],
        'prod_unit' => $product_row['prod_unit_id'],
        'prod_category' => $product_row['prod_category_id'],
        'prod_description' => $product_row['prod_description'],
        'prod_image' => $product_row['prod_image'],
        'prod_added' => $product_row['prod_added']
    ];

    // Add the product data to the array
    $dataArray[] = $productData;
}

// Close the database connection
mysqli_close($connections);

// Return the products as JSON response
header('Content-Type: application/json');
echo json_encode($dataArray);
?>