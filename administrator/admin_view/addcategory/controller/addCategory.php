<?php
include("../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catname = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['catname']));
    $catdescript = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '',$_POST['catdescript']));
    $acc_id = $_POST["acc_id"];

    // Prepare the SQL statement for INSERT
    $sql = "INSERT INTO category (category_name, category_description, category_status, category_date_created) VALUES (?, ?, '1', ?)";

    // Use a prepared statement to insert the new category
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("sss", $catname, $catdescript, $currentDateTime);

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
    $activity = "Created new category named: $catname";

    mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table) 
            VALUES ('$acc_id', '$activity', '$currentDateTime', 'category')");

    header("Location: categorylist.php");
    exit;
}

// Close the database connection
$connections->close();
?>
