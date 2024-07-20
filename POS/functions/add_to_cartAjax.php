<?php

/*
include('../config/config.php');
include('../functions/session.php');

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

                    $subtotal = $prod_currprice * $qty;

                    // Use a prepared statement to insert a new cart record
                    $insertSql = "INSERT INTO pos_cart (pos_cart_prod_id, pos_cart_user_id, cart_prodQty, subtotal) VALUES (?, ?, ?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("iddd", $prod_id, $acc_id, $qty, $subtotal);

                    if ($insertStmt->execute()) {
                        echo '<script>alert("Added to cart");</script>';
                    }

                    $insertStmt->close();
                }
            }
        }
    }
}
*/
?>