<?php
include "../../connection.php";

// Query to fetch the data from the database
$query = "
    SELECT 
    orders_tcode,
    orders_date,
    orders_subtotal,
    orders_discount,
    orders_tax,
    orders_payment,
    orders_change
    FROM pos_orders
    GROUP BY orders_tcode
";
$result = mysqli_query($connections, $query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF Orders</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="pt-4 d-flex flex-row justify-content-between">
            <div style="width: 80%">
                <h1 class="fw-bolder">Orders Report</h1>
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
        
        <!-- Table to display the data -->
        <table class="table table-bordered-bottom" style="font-size: 12px">
            <thead>
                <tr>
                    <th>Transaction Code</th>
                    <th>Order Date</th>
                    <th>Subtotal</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Payment</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the fetched data and display it in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['orders_tcode']}</td>";
                    echo "<td>{$row['orders_date']}</td>";
                    echo "<td>{$row['orders_subtotal']}</td>";
                    echo "<td>{$row['orders_discount']}</td>";
                    echo "<td>{$row['orders_tax']}</td>";
                    echo "<td>{$row['orders_payment']}</td>";
                    echo "<td>{$row['orders_change']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="mt-5 mb-5">
            <p class="m-0 p-0">________________________</p>
            <p class="m-0 p-0">Printed By</p>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
