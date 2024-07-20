<?php 
session_start();
include "../../connection.php";
include("back_navbar.php");

if(isset($_POST['add'])){
    $user = htmlentities($_SESSION['acc_id']);
    $qty = htmlentities($_POST['qty']);
    $prod_id = htmlentities($_POST['id']);

    // Check if the product is already in the cart for the user
    $check_cart_query = mysqli_query($connections, "SELECT * FROM pos_cart WHERE pos_cart_prod_id = '$prod_id' AND pos_cart_user_id = '$user'");
    
    if(mysqli_num_rows($check_cart_query) > 0) {
        // Product already exists in the cart, update the quantity
        $row_cart = mysqli_fetch_assoc($check_cart_query);
        $current_qty = $row_cart['cart_prodQty'];
        $new_qty = $current_qty + $qty;

        $update_query = mysqli_query($connections, "UPDATE pos_cart SET cart_prodQty = '$new_qty' WHERE pos_cart_prod_id = '$prod_id' AND pos_cart_user_id = '$user'");
        
        if($update_query){
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>
            alert('Failed to update cart');
            window.location.href='index.php';
            </script>";
        }
    } else {
        // Product doesn't exist in the cart, insert it
        $sql = "INSERT INTO `pos_cart` (`pos_cart_id`, `pos_cart_prod_id`, `pos_cart_user_id`, `cart_prodQty`) VALUES (NULL, '$prod_id', '$user', '$qty')";

        if(mysqli_query($connections, $sql)){
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>
            alert('Failed to add to cart');
            window.location.href='index.php';
            </script>";
        }
    }
} else {
    echo "<script>window.location.href='products.php';</script>";
}
?>
