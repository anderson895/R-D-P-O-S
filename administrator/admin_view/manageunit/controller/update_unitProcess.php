<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unit_name_update = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['unit_name_update']));
    $unit_description_update = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['unit_description_update']));
    $unit_status_update_select = $_POST["unit_status_update_select"];
    $acc_id = $_POST["acc_id"];
    $unit_id = $_POST["unit_id"];
    

    $get_record = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id = '$unit_id'");
    $row = mysqli_fetch_assoc($get_record);
    $db_unit_name = $row["unit_name"];
    $db_unit_description = $row["unit_description"];
    $db_unit_status = $row["unit_status"];
    $db_unit_date_edited = $row["unit_date_edited"];

    $sql = "UPDATE unit SET unit_name = '$unit_name_update', unit_description = '$unit_description_update', unit_status = '$unit_status_update_select', unit_date_edited = '$currentDateTime' WHERE unit_id = $unit_id";

    if ($stmt = $connections->prepare($sql)) {
        if ($stmt->execute()) {
            echo "Unit updated successfully.";

            $get_record = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id = '$unit_id'");
            $row = mysqli_fetch_assoc($get_record);
            $updated_db_unit_name = $row["unit_name"];
            $updated_db_unit_description = $row["unit_description"];
            $updated_db_unit_status = $row["unit_status"];
            $updated_db_unit_date_edited = $row["unit_date_edited"];

            if ($db_unit_name != $updated_db_unit_name) {
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', 'update `$db_unit_name` changed to `$updated_db_unit_name`', '$currentDateTime', 'unit', $unit_id)");
            }
            if ($db_unit_description != $updated_db_unit_description) {
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', '$updated_db_unit_name changed unit description', '$currentDateTime', 'unit', $unit_id)");
            }
            if ($db_unit_status != $updated_db_unit_status) {
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', '$updated_db_unit_name update status changed to $updated_db_unit_status ', '$currentDateTime', 'unit', $unit_id)");
            }

        } else {
            echo "Error updating unit: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connections->error;
    }
}

$connections->close();
?>
