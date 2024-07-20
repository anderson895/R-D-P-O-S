<?php
// Include your database connection code

include("../.../../../../../connection.php");

// Assuming the existence of the $connections variable for the database connection

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    $query = "
    SELECT 
        stocks.*, 
        SUM(stocks_details.ns_qty * stocks.s_supplierPrice) as totalCost,
        SUM((stocks_details.ns_qty * product.prod_currprice) - (stocks_details.ns_qty * stocks.s_supplierPrice)) as totalMarkup,
        product.*, 
        supplier.*,
        stocks_details.*
    FROM stocks
    LEFT JOIN product ON stocks.s_prod_id = product.prod_id
    LEFT JOIN supplier ON stocks.s_spl_id = supplier.spl_id
    LEFT JOIN stocks_details ON stocks_details.ns_stock_id = stocks.s_id
    WHERE stocks.s_status = '1' AND 
          (stocks.s_invoice LIKE '%$search%' OR 
           supplier.spl_name LIKE '%$search%' OR 
           stocks.s_stockin_date LIKE '%$search%')
    GROUP BY stocks.s_invoice
    ORDER BY stocks.s_stockin_date DESC
";


    $result = mysqli_query($connections, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        // Process each row and add it to the $data array
        $data[] = $row;
    }

    // Return the data as JSON
    echo json_encode($data);
} else {
    // Handle the case where the 'search' parameter is not set
    echo json_encode(array('error' => 'Search parameter not provided.'));
}

// Close the database connection
mysqli_close($connections);
?>
