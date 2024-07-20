<?php
// Include your database connection code here (initialize $conn)
include "../../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_type = $_POST['payment_type'];
    $paymentName = $_POST['payment_name_update'];
    $paymentNumber = $_POST['payment_rate_update'];

    // Handling file upload (if needed)
    $uploadPath = '../../upload_system/'; // Set your upload path
    $paymentImage = $_FILES['payment_image']['name'];
    $uploadedImagePath = $uploadPath . $paymentImage;
    
    if (move_uploaded_file($_FILES['payment_image']['tmp_name'], $uploadedImagePath)) {
        // Image uploaded successfully
    } else {
        // Image upload failed, handle the error (e.g., echo an error message)
    }

    // Insert data into the database
    $insertQuery = "INSERT INTO mode_of_payment (payment_name, payment_number, payment_image,payment_status,payment_type) 
                    VALUES ('$paymentName', '$paymentNumber', '$paymentImage','1','$payment_type')";

    if ($connections->query($insertQuery) === TRUE) {
        echo 'success'; // Sending a success response to the AJAX call
    } else {
        echo 'error'; // Sending an error response to the AJAX call
    }
}
?>
