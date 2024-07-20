<?php
include '../connection.php';
session_start();

if(!isset($_SESSION['acc_id'])) {
    header("Location: login.php");
    exit();
}

$acc_id= $_SESSION['acc_id'];

if(isset($_POST["add_to_cart"])) {
    $acc_id = $_POST["acc_id"];
    $prod_id = $_POST["prod_id"];
    $quantity = $_POST["quantity"];

    // Perform input validation and sanitation on $acc_id, $prod_id, and $quantity

    // Insert data into the pos_cart table
    $query = "INSERT INTO pos_cart (`pos_cart_prod_id`, `pos_cart_user_id`, `cart_prodQty`) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii",$prod_id ,$acc_id, $quantity);
    $stmt->execute();
    $stmt->close();
    header("Location: pos.php");
    echo "Item added to cart successfully!";
}


else if(isset($_POST["btn_qty"])) {
    $cart_id = $_POST["cart_id"];
    $qty = $_POST["qty"];

    $query = "UPDATE `pos_cart` SET `cart_prodQty` = '$qty' WHERE `pos_cart`.`pos_cart_id` = '$cart_id'";
    $result = $conn->query($query);
    header("Location: pos.php");
    
}

else if(isset($_POST["btn_delete"])) {
    $cart_id = $_POST["cart_id"];
    
    $query = "DELETE FROM pos_cart WHERE `pos_cart`.`pos_cart_id` = $cart_id";
    $result = $conn->query($query);
    header("Location: pos.php");
    
}

else if(isset($_POST["btn_clear"])) {

    $query = "DELETE FROM `pos_cart` WHERE pos_cart_user_id = $acc_id";
    $result = $conn->query($query);
    header("Location: pos.php");
    
}


?>