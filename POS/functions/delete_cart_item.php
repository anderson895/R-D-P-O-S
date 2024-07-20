
<?php

include ('../config/config.php');
include ('../functions/session.php');


echo "<pre>";
print_r($_POST);
echo "</pre>";
// Ensure that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'pos_cart_id' is set in the POST data
    if (isset($_POST['pos_cart_id'])) {
        // Retrieve 'pos_cart_id' from the POST data
        $pos_cart_prod_id = $_POST['pos_cart_prod_id'];

         //start back to the  stocks
    $stock_id_query = "SELECT * FROM pos_cart WHERE pos_cart_user_id='$acc_id'";
    $stock_id_result = mysqli_query($connections, $stock_id_query);

    if ($stock_id_result && mysqli_num_rows($stock_id_result) > 0) {
        while ($row = mysqli_fetch_assoc($stock_id_result)) {
            $orders_stock_id = $row['pos_cart_stock_id'];
            $cancelled_qty = $row['cart_prodQty'];

                // Update the stock quantity in the stocks table
                $update_stock_query = "UPDATE stocks SET s_amount = s_amount + '$cancelled_qty' WHERE s_id = '$orders_stock_id'";
                $update_stock_result = mysqli_query($connections, $update_stock_query);

                // Perform the delete operation in the orders table
               $delete_query = "DELETE FROM pos_cart WHERE pos_cart_prod_id	= '$pos_cart_prod_id[0]' ";
                $delete_result = mysqli_query($connections, $delete_query);

                if ($delete_result) {
                    // Deletion successful
                    echo 'success';
                } else {
                    echo 'error: ' . mysqli_error($connections);
                }
        }
    } else {
        // No matching order found
        echo 'error';
        
    }     //end back to the stocks

        // Prepare and execute a DELETE SQL query
        $sql = "DELETE FROM pos_cart WHERE pos_cart_prod_id = ? AND pos_cart_user_id ='$acc_id'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $pos_cart_prod_id);

        if ($stmt->execute()) {
            // Deletion was successful
           header("location: ../pages/pos");
        } else {
            // Deletion failed
            echo "Error deleting item: " . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // 'pos_cart_id' is not set in the POST data
        echo "pos_cart_id is not set in the POST data.";
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method. Only POST requests are allowed.";
}
?>
