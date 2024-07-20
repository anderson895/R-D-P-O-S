<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

echo "<pre>";
print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $discountName = $_POST['discount_name'];
    $description = $_POST["discount_description"];
    $discount_rate = $_POST["discount_rate"];
    $expirationDate = $_POST["expirationDate"];
    $MaximumLimit = $_POST["maxlimit"];
    $voucherStatus = $_POST["voucherStatus"];
    $acc_id = $_POST["acc_id"];

    

    // Prepare the SQL statement for INSERT
    $sql = "INSERT INTO voucher (voucher_name,voucher_discount,voucher_desciption,voucher_created,voucher_expiration,voucher_maximumLimit,voucher_status) VALUES (?, ?, ?, ?, ?, ?, 1)";

    // Use a prepared statement to insert the new category
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ssssss", $discountName, $discount_rate, $description, $currentDateTime,$expirationDate,$MaximumLimit);

        if ($stmt->execute()) {
            // Successful insertion
            echo "Discount inserted successfully.";
        } else {
            // Error handling for the prepared statement
            echo "Error inserting discount: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error handling for the prepared statement
        echo "Error preparing statement: " . $connections->error;
    }

    // Log the insert operation in the user activity log
    $activity = "Add new discount named: $discountName";


    $last_id = mysqli_insert_id($connections);
    mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table,act_collumn_id) 
            VALUES ('$acc_id', '$activity', '$currentDateTime', 'discount','$last_id')");

    exit;
}

// Close the database connection
$connections->close();
?>
