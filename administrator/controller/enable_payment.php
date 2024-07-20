<?php

include("../../connection.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentId = $_POST['db_payment_id'];

    // Update payment_status in the database
    $updateQuery = "UPDATE mode_of_payment SET payment_status = 1 WHERE payment_id = $paymentId";


    if ($connections->query($updateQuery) === TRUE) {
        echo 'success'; // Sending a success response to the AJAX call
    } else {
        echo 'error'; // Sending an error response to the AJAX call
    }
}
?>
