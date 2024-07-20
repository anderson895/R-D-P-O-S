<?php
include("../.../../../../../connection.php");

// Check if the connection is successful
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get account and payment details from the AJAX request
    $acc_id = $_POST['acc_id'];
    $payment_id = $_POST['payment_id'];
    $payment_status = $_POST['payment_status'];

    // SQL query to update payment status
    $sql = "UPDATE mode_of_payment SET payment_status = ? WHERE payment_id = ?";

    // Start user log
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    // Get payment name for the log
    $get_record = mysqli_query($connections, "SELECT * FROM mode_of_payment WHERE payment_id = '$payment_id'");
    $row = mysqli_fetch_assoc($get_record);
    $db_payment_name = $row["payment_name"];

    if ($payment_status == "2") {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                    VALUES('$acc_id', 'Remove $db_payment_name`s E-wallet', '$currentDateTime', 'mode_of_payment', '$payment_id')");
    }

    // Use prepared statement to prevent SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $payment_status, $payment_id);

        if ($stmt->execute()) {
            // Successful update
            echo "Payment status updated successfully.";
        } else {
            // Error in updating
            echo "Error updating payment status: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error in prepared statement
        echo "Error preparing statement: " . $connections->error;
    }
}

// Close the database connection
$connections->close();
?>
