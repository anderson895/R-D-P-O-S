<?php
include "../../connection.php";

// Query to fetch the data
$query = "
    SELECT 
        product.prod_id,
        product.prod_added,
        product.prod_code,
        product.prod_name,
        product.prod_currprice,
        product.barcode,
        product.unit_type,
        stocks.s_stock_in_qty
    FROM 
        stocks 
    JOIN 
        product 
    ON 
        stocks.s_prod_id = product.prod_id;
";

$result = mysqli_query($connections, $query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF Inventory</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="pt-4 d-flex flex-row justify-content-between">
            <div style="width: 80%">
                <h1 class="fw-bolder">Inventory Report</h1>
                <p class="m-0 p-0">R De Leon Poultry Supplies</p>
                <p class="m-0 p-0">Bagbaguin Sta. Maria Bulacan</p>
                <p class="m-0 p-0">rdeleon@gmail.com | 09876543211</p>
                <p class="m-0 p-0" id="date-today">Date today</p>
            </div>
            <div style="width: 20%">
                <img style="width: 50%;" src="assets/img/print_logo.png" alt="Company Logo">
            </div>
        </div>
        <hr>
        
        <table class="table table-bordered-bottom" style="font-size: 12px">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Code</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['prod_added']}</td>
                            <td>{$row['prod_code']}</td>
                            <td>{$row['prod_name']}</td>
                            <td>{$row['prod_currprice']}</td>
                            <td>{$row['unit_type']}</td>
                            <td>{$row['s_stock_in_qty']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="mt-5 mb-5">
            <p class="m-0 p-0">________________________</p>
            <p class="m-0 p-0">Printed By</p>
            <script>
                $(document).ready(function() {
                    // Get today's date
                    let today = new Date();
                    
                    // Format the date (e.g., 'MM/DD/YYYY')
                    let formattedDate = today.toLocaleDateString('en-US', {
                        month: 'long', day: 'numeric', year: 'numeric'
                    });
                    
                    // Set the formatted date in the <p> element
                    $('#date-today').text(`${formattedDate}`);
                });
            </script>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
