<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

echo "<pre>";
print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $discountName = $_POST['discountName'];
    $acc_id = $_POST["acc_id"];
    $description = $_POST["description"];
    $discountRate = $_POST["discountRate"];

    // Prepare the SQL statement for INSERT
    $sql = "INSERT INTO discount (discount_name, discount_description, discount_rate, discount_added, discount_status) VALUES (?, ?, ?, ?, 1)";

    // Use a prepared statement to insert the new category
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ssss", $discountName, $description, $discountRate, $currentDateTime);

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
