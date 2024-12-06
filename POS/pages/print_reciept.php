<?php
include('../config/config.php');
include('../functions/session.php');




if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Execute the SQL query to retrieve all records
    $table_sql = "
    SELECT
        SUM(t.orders_prodQty) as totalQTy,
        p.prod_currprice,
        p.prod_name,
        p.unit_type
    FROM
        pos_orders AS t
    JOIN
        product AS p
    ON
        t.orders_prod_id = p.prod_id
    WHERE
        t.orders_tcode = '$id'
     group by t.orders_prod_id
    ;
    ";

    $result = $conn->query($table_sql);

    if ($result->num_rows > 0) {

        $tbody = '';

        while ($row = $result->fetch_assoc()) {
            $tbody .= '
            <tr >
            <td class="pt-1">' . (strlen($row["prod_name"]) > 20 ? substr($row["prod_name"], 0, 30) . '...' : $row["prod_name"]) . '</td>
            <td class="text-end">' . $row["prod_currprice"] . ' x ' . $row["totalQTy"] . $row['unit_type'] . '</td>
        </tr>';
        }
    } else {
        echo "No results found.";
    }


    // Execute the SQL query
    $sql = "
    SELECT
    t.orders_barcode,
    SUM(t.orders_prodQty * orders_prod_price) Allsubtotal,
    t.orders_prod_id,
        CONCAT(
            t.orders_subtotal, ',',
            t.orders_discount, ', ',
            t.orders_tax, ', ',
            t.orders_final, ', ',
            t.orders_payment, ', ',
            t.orders_date, ', ',
            t.orders_change, ', ',
             CONCAT(a.acc_fname, ' ', a.acc_lname)
        ) AS transaction_info
    FROM
        pos_orders AS t
    JOIN
        product AS p
    ON
        t.orders_prod_id = p.prod_id
    JOIN
        account AS a
    ON
        t.orders_user_id = a.acc_id
    WHERE
        t.orders_tcode = '$id'
    Group by t.orders_tcode

        ;
    ";

    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {


        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $data = $row["transaction_info"];
            $db_order_barcode = $row["orders_barcode"];
            $Allsubtotal = $row["Allsubtotal"];
        }

        $dataArray = explode(",", $data);

        if (count($dataArray) === 8) {
            list($subtotal, $discount, $tax, $total, $payment, $date, $change, $cashier) = $dataArray;
        } else {
            echo "The input data does not contain exactly 8 values separated by commas.";
        }
    } else {
        echo "No results found.";
    }
} else {
    header("location: pos");
}


$spacedId = implode(' ', str_split($id));
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/print.css">

</head>

<body>
    <div class="navigations">
        <?php include '../includes/navigation.php'; ?>
    </div>
    <div class="receipt shadow">
        <div class="receipt-header">
            <h2 class="mt-3 fw-bold"><?= $db_system_name ?></h2>
            <p class="text-center m-0">R De Leon Poultry Supplies</p>
            <p class="text-center m-0">Date: <?php echo $date ?></p>
            <p class="text-center m-0">Contact: <?= $db_system_contact ?></p>
            <p class="text-center m-0">Address: <?= $db_system_address ?></p>
            <div justify-content-center d-flex flex-column align-items-center><img src="../../upload_barcode/<?= $db_order_barcode ?>" class='w-75' alt=""></div>
            <?= $spacedId ?>
            <p class="text-center m-0">Printed by: <?php echo $cashier?></p>

        </div>

        <hr>
        <div class="receipt-content">
            <div class="div-scroll">
                <table class=" w-100">
                    <thead>
                        <th width="60%">Item</th>
                        <th width="40%">Price</th>
                    </thead>

                    <tbody>
                        <?php echo $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>

        <table width="100%">
            <tbody>
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-end"> <?php echo $Allsubtotal ?></td>
                </tr>
                <tr>
                    <td>Discount:</td>
                    <td class="text-end"> <?php echo $discount ?></td>
                </tr>
                <tr>
                    <td>VAT:</td>
                    <td class="text-end"> <?php echo $tax ?></td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td class="text-end"> <?php echo $total ?></td>
                </tr>
                <tr>
                    <td>Payment:</td>
                    <td class="text-end"> <?php echo $payment ?></td>
                </tr>
                <tr>
                    <td>Change</td>
                    <td class="text-end"> <?php echo $change ?></td>
                </tr>
            </tbody>


        </table>
        <hr>

        <p class="text-center mb-2">Thanks for shopping</p>
        <div class="d-flex justify-content-center mb-3">
            <button id="printButton" class="btn btn-sm btn-primary w-100">Print</button>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>

</body>

</html>