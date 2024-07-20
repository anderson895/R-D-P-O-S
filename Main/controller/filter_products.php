<?php
include("../../connection.php"); // Adjust the path as needed

if (isset($_POST['query'])) {
   echo $query = $_POST['query'];
    
    // Execute the new query to fetch filtered products
    $filteredProductsQuery = mysqli_query($connections, $query);

    if (!$filteredProductsQuery) {
        // Handle the query error as needed
        die("Query failed: " . mysqli_error($connections));
    }

    // Create an array to store the filtered product data
    $filteredProductData = array();

    // Fetch and store the filtered product data
    while ($product_row = mysqli_fetch_assoc($filteredProductsQuery)) {
        // Adjust this array structure to match your product data
        $productData = array(
            'prod_id' => $product_row["prod_id"],
            'prod_name' => $product_row["prod_name"],
            'prod_orgprice' => $product_row["prod_orgprice"],
            'prod_currprice' => $product_row["prod_currprice"],
            'prod_stocks' => $product_row["prod_stocks"],
            'prod_unit' => $product_row["prod_unit_id"],
            'prod_category' => $product_row["prod_category_id"],
            'prod_description' => $product_row["prod_description"],
            'prod_image' => $product_row["prod_image"]
        );

        // Add the product data to the array
        $filteredProductData[] = $productData;
    }

    // Close the database connection (if needed)
    mysqli_close($connections);

    // Return the filtered product data as a JSON response
    header('Content-Type: application/json');
    echo json_encode($filteredProductData);
} else {
    // Handle invalid requests
    echo "Invalid request.";
}
?>
