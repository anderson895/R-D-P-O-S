<?php
include('../config/config.php');

// Check if the request is a POST request
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the cart item ID and new quantity from the request
    $cartItemId = isset($_POST['cartItemId']) ? intval($_POST['cartItemId']) : 0;
    $newQuantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
    $subtotal = isset($_POST['subtotal']) ? floatval($_POST['subtotal']) : 0; // Parse subtotal as a float

    // Check if cartItemId and newQuantity are valid
    if ($cartItemId > 0 && $newQuantity >= 0) {
        // Update the cart item quantity and subtotal in the database
        $sql = "UPDATE pos_cart SET cart_prodQty = ?, subtotal = ? WHERE pos_cart_id = ?";
        $stmt = $conn->prepare($sql);

        // Bind the parameters and execute the query
        $stmt->bind_param("idi", $newQuantity, $subtotal, $cartItemId);

        if ($stmt->execute()) {
            // The update was successful
            $response = array('success' => true, 'message' => 'Quantity and subtotal updated successfully');
            echo json_encode($response);
        } else {
            // The update failed
            $response = array('success' => false, 'message' => 'Failed to update quantity and subtotal');
            echo json_encode($response);
        }
    } else {
        // Invalid or missing parameters
        $response = array('success' => false, 'message' => 'Invalid parameters');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method';
}
*/
?>
