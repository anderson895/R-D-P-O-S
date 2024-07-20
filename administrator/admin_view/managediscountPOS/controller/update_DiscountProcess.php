<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');
echo "<pre>";
print_r($_POST);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acc_id = $_POST["acc_id"];
    $discount_id_update = $_POST['discount_id_update'];
    $discount_name_update =$_POST['discount_name_update'];
    $discount_description_update = $_POST["discount_description_update"];
    $discount_rate_update = $_POST["discount_rate_update"];
    $discount_status_update_select = $_POST["discount_status_update_select"];
    
    

    $get_record = mysqli_query($connections, "SELECT * FROM discount WHERE discount_id = '$discount_id_update'");
    $row = mysqli_fetch_assoc($get_record);
    $db_discount_name = $row["discount_name"];
    $db_discount_description = $row["discount_description"];
    $db_discount_rate = $row["discount_rate"];
    $db_discount_edited = $row["discount_edited"];
    $db_discount_status = $row["discount_status"];

    $sql = "UPDATE discount SET discount_name = '$discount_name_update', discount_description = '$discount_description_update',
     discount_rate = '$discount_rate_update', discount_edited = '$currentDateTime', discount_status= '$discount_status_update_select' WHERE discount_id = $discount_id_update";

    if ($stmt = $connections->prepare($sql)) {
        if ($stmt->execute()) {
            echo "Unit updated successfully.";

            $get_record = mysqli_query($connections, "SELECT * FROM discount WHERE discount_id = '$discount_id_update'");
            $row = mysqli_fetch_assoc($get_record);
            $updated_db_discount_name = $row["discount_name"];
            $updated_db_discount_description = $row["discount_description"];
            $updated_db_discount_rate = $row["discount_rate"];
            $updated_db_discount_status = $row["discount_status"];
           

            if ($db_discount_name != $updated_db_discount_name) {
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', 'update `$db_discount_name` name changed to `$updated_db_discount_name`', '$currentDateTime', 'discount', $discount_id_update)");
            }
            if ($db_discount_description != $updated_db_discount_description) {
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', 'update $db_discount_name description', '$currentDateTime', 'discount', $discount_id_update)");
            }
            if ($db_discount_rate != $updated_db_discount_rate) {
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', 'update $updated_db_discount_name discount rate from $db_discount_rate% changed to $updated_db_discount_rate%', '$currentDateTime', 'discount', $discount_id_update)");
            }

            if ($db_discount_status != $updated_db_discount_status) {

                if($db_discount_status=="1"){

                    $db_discount_status="Enable";
                }else{
                    $db_discount_status="Dsiabled";
                }

                if($updated_db_discount_status=="1"){

                    $updated_db_discount_status="Enable";
                }else{
                    $updated_db_discount_status="Dsiabled";
                }



                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', 'update $updated_db_discount_name from $db_discount_status changed to $updated_db_discount_status ', '$currentDateTime', 'discount', $discount_id_update)");
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
