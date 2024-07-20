<?php
// updateMod_payment.php

include("../../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentId = $_POST["db_payment_id_update"];
    $paymentName = $_POST["db_payment_name_update"];
    $paymentNumber = $_POST["db_payment_number_update"];

    // Sanitize inputs to prevent SQL injection
    $paymentId = mysqli_real_escape_string($connections, $paymentId);
    $paymentName = mysqli_real_escape_string($connections, $paymentName);
    $paymentNumber = mysqli_real_escape_string($connections, $paymentNumber);

    // Check if an image is uploaded
    if (!empty($_FILES["db_payment_image_update"]["name"])) {
        $targetDir = "../../upload_system/"; // Change this to your upload directory
        $imageName = basename($_FILES["db_payment_image_update"]["name"]);
        $targetPath = $targetDir . $imageName;

        // Move uploaded image to the target directory
        move_uploaded_file($_FILES["db_payment_image_update"]["tmp_name"], $targetPath);

        // Update payment details with image
        $sql = "UPDATE mode_of_payment SET payment_name = '$paymentName', payment_number = '$paymentNumber', payment_image = '$imageName' WHERE payment_id = $paymentId";
    } else {
        // Update payment details without image
        $sql = "UPDATE mode_of_payment SET payment_name = '$paymentName', payment_number = '$paymentNumber' WHERE payment_id = $paymentId";
    }

    if ($connections->query($sql) === TRUE) {
        echo "Payment details updated successfully!";
    } else {
        // Log the error for debugging purposes
      
        // Provide a user-friendly response
        echo "An error occurred while updating payment details. Please try again later.";
    }
}

// Close the database connection
$connections->close();
?>
