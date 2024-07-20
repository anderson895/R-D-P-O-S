<?php
print_r($_POST);

include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierName = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['supplierName']));
    $acc_id = $_POST["acc_id"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $spl_id =$_POST["spl_id"];


    $get_record = mysqli_query ($connections,"SELECT * FROM supplier where spl_id ='$spl_id' ");
    $row = mysqli_fetch_assoc($get_record);
     $old_db_spl_name = $row["spl_name"];

    // Prepare the SQL statement for UPDATE
    $sql = "UPDATE supplier SET spl_name=?, spl_email=?, spl_contact=?, spl_address=?, spl_date_edited=? WHERE spl_id=?";

    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("sssssi", $supplierName, $email, $phone, $address, $currentDateTime, $spl_id);

        if ($stmt->execute()) {
            // Successful update
            echo "Supplier updated successfully.";
        } else {
            // Error handling for the prepared statement
            echo "Error updating supplier: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error handling for the prepared statement
        echo "Error preparing statement: " . $connections->error;
    }
   
    // Log the update operation in the user activity log
    $spl_code = sprintf("SU%05d%02d", $acc_id % 100, $acc_id);
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', 'Updated supplier name:`$old_db_spl_name` change to `$supplierName`', '$currentDateTime','supplier','$spl_code')");

    // Close the database connection
    $connections->close();
}
?>
