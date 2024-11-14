<?php
include "../../connection.php";

// Query to fetch the data
$query = "
    SELECT 
        order_transaction_code,
        ANY_VALUE(orders_date) AS orders_date,
        ANY_VALUE(orders_subtotal) AS orders_subtotal,
        ANY_VALUE(orders_gradeTotal) AS orders_gradeTotal,
        ANY_VALUE(orders_ship_fee) AS orders_ship_fee,
        ANY_VALUE(orders_tax) AS orders_tax
    FROM orders
    GROUP BY order_transaction_code;
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
        
        <!-- Table to display the orders data -->
        <table class="table table-bordered-bottom" style="font-size: 12px">
            <thead>
                <tr>
                    <th>Order Transaction Code</th>
                    <th>Order Date</th>
                    <th>Order Subtotal</th>
                    <th>Order Grade Total</th>
                    <th>Order Ship Fee</th>
                    <th>Order Tax</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_transaction_code']); ?></td>
                        <td><?php echo htmlspecialchars($row['orders_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['orders_subtotal']); ?></td>
                        <td><?php echo htmlspecialchars($row['orders_gradeTotal']); ?></td>
                        <td><?php echo htmlspecialchars($row['orders_ship_fee']); ?></td>
                        <td><?php echo htmlspecialchars($row['orders_tax']); ?></td>
                    </tr>
                <?php endwhile; ?>
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
