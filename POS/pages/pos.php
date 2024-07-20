<?php
include('../config/config.php');
include('../functions/session.php');



date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if (isset($_POST['prod_id'], $_POST['amount'], $_POST['acc_id'])) {
    $acc_id = $_POST['acc_id'];
    $prod_id = $_POST['prod_id'];
    $qty = $_POST['amount'];
    $stocks = $_POST['stocks']; // Assuming you have retrieved the stocks value somewhere

    if ($qty <= 0 || $qty > $stocks) {
        echo '<script>alert("Invalid quantity");</script>';
    } else {
        // Check if the product is already in the cart
        $checkSql = "SELECT * FROM pos_cart WHERE pos_cart_prod_id = ? AND pos_cart_user_id = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ii", $prod_id, $acc_id);

        if ($checkStmt->execute()) {
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                echo '<script>alert("Already Added");</script>';
            } else {

                // Product doesn't exist in the cart, insert a new record
                // Retrieve product price using a prepared statement
                $sql = "SELECT prod_currprice FROM product WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $prod_id);

                if ($stmt->execute()) {

                    $stmt->bind_result($prod_currprice);
                    $stmt->fetch();
                    $stmt->close();



                    // Start deduct

                    $get_record = mysqli_query($conn, "
                          SELECT *
                          FROM product AS a
                          LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
                          WHERE a.prod_status = '0'
                                AND a.prod_id = '$prod_id'
                                AND s_amount > 0 
                                AND (DATE(b.s_expiration) >= CURDATE() OR b.s_expiration = '0000-00-00')
                          ORDER BY b.s_expiration ASC;
                        ");


                    $remainingQty = $qty;

                    while ($stock_row = $get_record->fetch_array()) {
                        $db_s_id = $stock_row["s_id"];
                        $db_s_amount = $stock_row["s_amount"];
                        $db_s_expiration = $stock_row["s_expiration"];

                        if ($db_s_amount > 0 && ($db_s_expiration === '0000-00-00' || strtotime($db_s_expiration) >= strtotime('today'))) {
                            $deductQty = min($remainingQty, $db_s_amount);
                            $remainingQty -= $deductQty;

                            mysqli_query($conn, "UPDATE stocks SET s_amount = s_amount - '$deductQty' WHERE s_id = '$db_s_id' ");

                            $subtotal = $prod_currprice * $deductQty;
                        }



                        // Use a prepared statement to insert a new cart record
                        $insertSql = "INSERT INTO pos_cart (pos_cart_prod_id, pos_cart_user_id, cart_prodQty,pos_cart_stock_id, subtotal) VALUES (?, ?, ?, ?, ?)";
                        $insertStmt = $conn->prepare($insertSql);
                        $insertStmt->bind_param("idddd", $prod_id, $acc_id, $deductQty, $db_s_id, $subtotal);

                        if ($insertStmt->execute()) {
                            //  echo '<script>alert('.$qty.');</script>';
                        } else {
                            echo '<script>alert("Failed to add to cart");</script>';
                        }

                        $insertStmt->close();

                        if ($remainingQty <= 0) {
                            break;
                        }
                    }
                }
            }
        }
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="overflow: hidden;">

    <?php include('../includes/navigation.php'); ?>

    <div class="container">
        <div class="row mt-3 " style="height: 520px">
            <div class="col-12 col-md-7 ">
                <div class="input-group shadow rounded">

                    <input type="text" id="searchInput" placeholder="Search product here" class="form-control">
                    <button class="btn btn-primary">Search</button>
                </div>
                <div class="container mt-3 px-0 ">
                    <div class="row product" style="overflow:scroll; height: 491px;"></div>
                </div>
            </div>
            <div class="col-12 col-md-5 ">
                <?php include '../functions/table_product_cart.php'; ?>
            </div>
        </div>
    </div>

    <script src="../assets/js/login-loading.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <script type="text/javascript" src="../assets/js/pos-product.js"></script>


</body>

</html>