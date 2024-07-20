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
    $discount_maxlimit_update_select = $_POST["discount_maxlimit_update_select"];
    $discount_status_update_select = $_POST["discount_status_update_select"];
    $expirationDate_update=$_POST["expirationDate_update"];
    
    

    $get_record = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_id = '$discount_id_update'");
    $row = mysqli_fetch_assoc($get_record);
    $db_voucher_name = $row["voucher_name"];
    $db_voucher_discount = $row["voucher_discount"];
    $db_voucher_desciption = $row["voucher_desciption"];
    $db_voucher_created = $row["voucher_created"];
    $db_voucher_expiration = $row["voucher_expiration"];
    $db_voucher_maximumLimit = $row["voucher_maximumLimit"];
    $db_voucher_status = $row["voucher_status"];
    $db_voucher_expiration = $row["voucher_expiration"];


    $sql = "UPDATE voucher SET 
    voucher_status = '$discount_name_update', 
    voucher_discount ='$discount_rate_update',
    voucher_desciption = '$discount_description_update',
    voucher_date_edit = '$currentDateTime', 
    voucher_expiration = '$expirationDate_update', 
    voucher_maximumLimit='$discount_maxlimit_update_select',
    voucher_status= '$discount_status_update_select' 
    
    WHERE voucher_id = $discount_id_update";

    if ($stmt = $connections->prepare($sql)) {
        if ($stmt->execute()) {
            echo "Unit updated successfully.";

            $get_record = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_id = '$discount_id_update'");
            $row = mysqli_fetch_assoc($get_record);

            $Updated_db_voucher_name = $row["voucher_name"];
            $Updated_db_voucher_discount = $row["voucher_discount"];
            $Updated_db_voucher_desciption = $row["voucher_desciption"];
            $Updated_db_voucher_created = $row["voucher_created"];
            $Updated_db_voucher_expiration = $row["voucher_expiration"];
            $Updated_db_voucher_maximumLimit = $row["voucher_maximumLimit"];
            $Updated_db_voucher_status = $row["voucher_status"];
           

            // if ($db_discount_name != $Updated_db_voucher_name) {
            //     mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
            //     VALUES ('$acc_id', 'update `$db_discount_name` name changed to `$updated_db_discount_name`', '$currentDateTime', 'discount', $discount_id_update)");
            // }
            // if ($db_discount_description != $updated_db_discount_description) {
            //     mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
            //     VALUES ('$acc_id', 'update $db_discount_name description', '$currentDateTime', 'discount', $discount_id_update)");
            // }
            // if ($db_discount_rate != $updated_db_discount_rate) {
            //     mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
            //     VALUES ('$acc_id', 'update $updated_db_discount_name discount rate from $db_discount_rate% changed to $updated_db_discount_rate%', '$currentDateTime', 'discount', $discount_id_update)");
            // }

            if ($db_voucher_status != $Updated_db_voucher_status) {

                if($db_voucher_status=="1"){

                    $db_voucher_status="Enable";
                }else{
                    $db_voucher_status="Dsiabled";
                }

                if($db_voucher_status=="1"){

                    $db_voucher_status="Enable";
                }else{
                    $db_voucher_status="Dsiabled";
                }



                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES ('$acc_id', 'update $Updated_db_voucher_name from $db_voucher_status changed to $db_voucher_status ', '$currentDateTime', 'voucher', $discount_id_update)");
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
