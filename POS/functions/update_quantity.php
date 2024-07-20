<?php
include('../config/config.php');


print_r($_POST);



?>
<?php
    // Include your database connection file here

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming you have sanitized input, if not, please do so to prevent SQL injection
        $cartItemId = $_POST["cartItemId"];
        $posCartProdId = $_POST["posCartProdId"]; // Add this line to retrieve 'posCartProdId'
        $quantity = $_POST["quantity"];
        $subtotal = $_POST["subtotal"];

        // Update the pos_cart table with the new quantity
        $updateCartQuery = "UPDATE pos_cart 
                            SET cart_prodQty = $quantity, subtotal = $subtotal 
                            WHERE pos_cart_id = $cartItemId AND pos_cart_prod_id = $posCartProdId"; // Use 'posCartProdId' in the query

        $updateCartResult = mysqli_query($conn, $updateCartQuery);

        if (!$updateCartResult) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Output success or any other response as needed
        echo "Quantity updated successfully";
    } else {
        // Handle invalid requests or provide an error message
        echo "Invalid request";
    }
?>
