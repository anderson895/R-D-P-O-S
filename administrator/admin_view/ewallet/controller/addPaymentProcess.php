<?php
include("../../../../connection.php");

$uploadDir = "../../../../upload_system/";
// Start user log
date_default_timezone_set('Asia/Manila'); // Set the time zone to Manila

$currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time in Manila time

// Check connection
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

print_r($_POST);

// Process file upload
if ($_FILES["profilePicture"]["error"] === UPLOAD_ERR_OK) {
    $tempFileName = $_FILES["profilePicture"]["tmp_name"];
    $originalFileName = $_FILES["profilePicture"]["name"];
    $targetFilePath = $uploadDir . basename($originalFileName); // Full file path

    // Move the uploaded file to the target location
    if (move_uploaded_file($tempFileName, $targetFilePath)) {
        // File uploaded successfully, proceed with inserting into the database
        $paymentName = mysqli_real_escape_string($connections, $_POST["paymentName"]);
        $paymentNumber = mysqli_real_escape_string($connections, $_POST["paymentNumber"]);
        $acc_id = mysqli_real_escape_string($connections, $_POST["acc_id"]);
        $PaymentStatus = $_POST["PaymentStatus"];

        // Prepare the SQL statement with the current date and time and file path
        $sql = "INSERT INTO mode_of_payment (payment_name, payment_number, payment_image, payment_status, payment_type, payment_date_added)
                VALUES ('$paymentName', '$paymentNumber', '" . basename($originalFileName) . "', '$PaymentStatus', 'ewallet', '$currentDateTime')";

        if ($connections->query($sql) === TRUE) {
            // Success, redirect or display a success message
            $last_id = $connections->insert_id;
            $code = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $last_id_mod = $last_id % 100;
            $payment_code = sprintf("00%05d%02d", $code, $last_id_mod);

            $query = "UPDATE mode_of_payment SET payment_code='" . $payment_code . "' WHERE payment_id ='" . $last_id . "' ";
            if (mysqli_query($connections, $query)) {
                // Success, redirect or display a success message

                mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
                        VALUES('$acc_id', 'Added payment method: $paymentName', '$currentDateTime','ewallet','$last_id')");
                // End user log

                echo "New record inserted successfully";
            } else {
                echo "Error updating product table: " . mysqli_error($connections);
            }
        } else {
            echo "Error inserting into mode_of_payment: " . $connections->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Error during file upload: " . $_FILES["profilePicture"]["error"];
}

// Close the connection
$connections->close();
?>
