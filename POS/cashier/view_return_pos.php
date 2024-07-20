<?php
include('../config/config.php');
include('../functions/session.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM returns_pos rt
        JOIN product p ON rt.ret_product_id = p.prod_id
        WHERE ret_transaction_code = '$id'";

    $result = mysqli_query($conn, $sql);

    // Check for errors in the query
    if (!$result) {
        die('Error in the SQL query: ' . mysqli_error($conn));
    }

    // Initialize $tbody variable
    $tbody = '';

    // Fetch data and store in $tbody
    while ($row = mysqli_fetch_assoc($result)) {
        $prod_name = $row['prod_name'];
        $ret_prod_price = $row['ret_prod_price'];
        $ret_qty = $row['ret_qty'];
        // Add the retrieved data to $tbody
        $tbody .= "<tr>
        <td>$prod_name</td>
        <td class='text-end'>$ret_prod_price</td>
        <td class='text-end'>$ret_qty</td>
        </tr>";
    }

    // Free the result set
    mysqli_free_result($result);

    // Your SQL query with JOIN
    $sql = "SELECT rp.ret_date, rp.ret_datepurchase, rp.ret_reason, rp.ret_type, CONCAT(a.acc_fname, '', a.acc_lname) as 'name'
            FROM returns_pos rp
            JOIN account a ON rp.ret_cashier_id = a.acc_id
            WHERE rp.ret_transaction_code = '$id'
            GROUP BY rp.ret_date, rp.ret_datepurchase
            HAVING COUNT(*) > 1";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Initialize an array to store the results
        $resultsArray = array();

        // Fetch the results as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            // Access the columns by name
            $retDate = $row['ret_date'];
            $ret_reason = $row['ret_reason'];
            $ret_type = $row['ret_type'];
            $ret_datepurchase = $row['ret_datepurchase'];
            $accountName = $row['name'];

        }

        
    } else {
        // If the query fails, you can handle the error here
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    header("location: pos");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">


    <link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/scrollbar/scroll.min.css">
    <link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/alertify/alertify.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .right{
        text-align: end;
    }
    </style>
</head>
<body >

<?php include ('../includes/navigation.php');?>



<div class="container ">
    <div class="row ">
        <div class="col-12 col-md-2 mt-3"></div>
        <div class="col-12 col-md-8 mt-3">
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Return Summary</h5>
            <div class="container border rounded py-2" >
            <table style="width: 100%;">
                <tr>
                    <td>Transaction Code: </td>
                    <td class="right"> <?php echo $id?></td>
                </tr>
                <tr>
                    <td>Date of Purchase: </td>
                    <td class="right"> <?php echo $ret_datepurchase?></td>
                </tr>
                <tr>
                    <td>Date of Return: </td>
                    <td class="right"> <?php echo $retDate?></td>
                </tr>
                <tr>
                    <td>Cashier Name: </td>
                    <td class="right"> <?php echo $accountName?></td>
                </tr>
                <tr>
                    <td>Reason: </td>
                    <td class="right"> <?php echo $ret_reason?></td>
                </tr>
                <tr>
                    <td>Type: </td>
                    <td class="right"> <?php echo $ret_type?></td>
                </tr>
                
            </table>
            </div>
            <div class="container mt-3 border rounded py-2" >
                <div style="overflow: auto; height: 250px;">
            <table class="table" style="width: 100%; ">
            <thead>
                
                <th>Replace Product</th>
                <th class="text-end">Price</th>
                <th class="text-end">Qty</th>
            </thead>
                <div >
                    <?php echo $tbody?>
                </div>
            </table>
            </div>
            </div>
            </div>
            
        </div>

        

        
    </div>
</div>










<script src="../../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
<script src="../../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


<script src='../assets/js/checkbox.js'></script>