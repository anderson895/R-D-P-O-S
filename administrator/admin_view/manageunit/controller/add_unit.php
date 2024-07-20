<?php
include("../../../../connection.php");


date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unit_name = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['unit_name']));
    $acc_id = $_POST["acc_id"];
    $unit_description=$_POST["unit_description"];
    $unitStatus=$_POST["unitStatus"];

    // Prepare the SQL statement for INSERT
    $sql = "INSERT INTO unit (unit_name, unit_description, unit_status, unit_date_added) VALUES (?, ?, ?, ?)";

    // Use a prepared statement to insert the new category
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ssss", $unit_name,$unit_description, $unitStatus, $currentDateTime);

        if ($stmt->execute()) {
            // Successful insertion
            echo "Category inserted successfully.";
        } else {
            // Error handling for the prepared statement
            echo "Error inserting category: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error handling for the prepared statement
        echo "Error preparing statement: " . $connections->error;
    }

    // Log the insert operation in the user activity log
    $activity = "Add new unit named: $unit_name";

    mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table) 
            VALUES ('$acc_id', '$activity', '$currentDateTime', 'unit')");

   
    exit;
}

// Close the database connection
$connections->close();
?>
