<?php
include "../../connection.php";

if (isset($_POST['itemsToRemove'])) {
    $itemsToRemove = $_POST['itemsToRemove'];

    if (!empty($itemsToRemove)) {
        $itemsToRemove = array_map('intval', $itemsToRemove);
        $itemsToRemoveStr = implode(',', $itemsToRemove);

        // Construct the delete query
        $deleteQuery = "DELETE FROM cart WHERE cart_prod_id IN ($itemsToRemoveStr)";

        // Execute the delete query
        $result = mysqli_query($connections, $deleteQuery);  // Changed $connections to $connection

        if ($result) {
            // Deletion successful
            // You can send a success response if needed
            echo json_encode(array('status' => 'success'));
        } else {
            // Deletion failed
            // You can send an error response if needed
            echo json_encode(array('status' => 'error', 'message' => 'Failed to delete items from the cart.'));
        }
    } else {
        // No items to remove
        // You can send a response indicating this
        echo json_encode(array('status' => 'error', 'message' => 'No items selected to remove.'));
    }
} else {
    // Invalid request
    // You can send a response indicating this
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}
?>
