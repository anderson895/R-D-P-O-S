<?php
include("../../../../connection.php");

$uploadDir = "../../../../upload_system/";
date_default_timezone_set('Asia/Manila'); // Set the time zone to Manila

$currentDateTime = date('Y-m-d H:i:s'); // Get the current date and time in Manila time


if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

print_r($_POST);

$paymentName = mysqli_real_escape_string($connections, $_POST["paymentName"]);
$paymentNumber = mysqli_real_escape_string($connections, $_POST["paymentNumber"]);
$PaymentStatus = $_POST["PaymentStatus"];
$payment_id = $_POST["payment_id"];
$acc_id = mysqli_real_escape_string($connections, $_POST["acc_id"]);


        $get_record = mysqli_query ($connections,"SELECT * FROM mode_of_payment where payment_id='$payment_id' ");
		$row = mysqli_fetch_assoc($get_record);
        $db_payment_name = $row["payment_name"];
        $db_payment_number = $row["payment_number"];
        $db_payment_image = $row["payment_image"];
        $db_payment_status= $row["payment_status"];


// Check if a new profile picture is being uploaded
if (!empty($_FILES["profilePicture"]["name"])) {
    // Process file upload
    if ($_FILES["profilePicture"]["error"] === UPLOAD_ERR_OK) {
        $tempFileName = $_FILES["profilePicture"]["tmp_name"];
        $originalFileName = basename($_FILES["profilePicture"]["name"]); // Extract filename
        $targetFilePath = $uploadDir . $originalFileName;  // Use the extracted filename
    
        if (move_uploaded_file($tempFileName, $targetFilePath)) {
            $profilePicturePath = $targetFilePath;

            
$sql = "UPDATE mode_of_payment SET 
payment_name='$paymentName', 
payment_number='$paymentNumber', 
payment_image='$originalFileName', 
payment_status='$PaymentStatus', 
payment_type='bank', 
payment_date_edited='$currentDateTime' 
WHERE payment_id='$payment_id'";

if ($connections->query($sql) === TRUE) {

        $get_record = mysqli_query ($connections,"SELECT * FROM mode_of_payment where payment_id='$payment_id' ");
        $row = mysqli_fetch_assoc($get_record);
		 $updated_db_payment_name = $row["payment_name"];
         $updated_db_payment_number = $row["payment_number"];
         $updated_db_payment_image = $row["payment_image"];
         $updated_db_payment_status= $row["payment_status"];
    
    if($db_payment_name!=$updated_db_payment_name){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
    VALUES('$acc_id', 'Update Bank name from`$db_payment_name` changed to `$updated_db_payment_name`', '$currentDateTime','product','$payment_id')");
    }    

    if($db_payment_number!=$db_payment_number){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
    VALUES('$acc_id', 'Update Bank number from`$db_payment_number` changed to `$updated_db_payment_number`', '$currentDateTime','product','$payment_id')"); 
     }   

    if($db_payment_image!=$updated_db_payment_image){
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
        VALUES('$acc_id', 'Update $updated_db_payment_name` Bank image', '$currentDateTime','product','$payment_id')");     
    } 
    if($db_payment_status!=$updated_db_payment_status){
        if($updated_db_payment_status=="0"){
            $updated_db_payment_status_log=="Disabled Bank $updated_db_payment_name";
        }else{
            $updated_db_payment_status_log=="Enabled Bank $updated_db_payment_name";
        }
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
        VALUES('$acc_id', '$updated_db_payment_status_log` changed to `$updated_db_payment_name`', '$currentDateTime','product','$payment_id')");     
    }        

echo "Record updated successfully";
} else {
echo "Error updating mode_of_payment: " . $connections->error;
}


        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        echo "Error during file upload: " . $_FILES["profilePicture"]["error"];
        exit;
    }
} else {
    // No new profile picture uploaded, retain the existing picture path
    $profilePicturePath = '';  // Modify this with the actual logic to retrieve the existing path from the database
    
        $sql = "UPDATE mode_of_payment SET 
        payment_name='$paymentName', 
        payment_number='$paymentNumber', 
        payment_status='$PaymentStatus', 
        payment_type='bank', 
        payment_date_edited='$currentDateTime' 
        WHERE payment_id='$payment_id'";

if ($connections->query($sql) === TRUE) {
    // Updated record successfully
    
$get_record = mysqli_query ($connections,"SELECT * FROM mode_of_payment where payment_id='$payment_id' ");
$row = mysqli_fetch_assoc($get_record);
 $updated_db_payment_name = $row["payment_name"];
 $updated_db_payment_number = $row["payment_number"];
 $updated_db_payment_image = $row["payment_image"];
 $updated_db_payment_status= $row["payment_status"];

if($db_payment_name!=$updated_db_payment_name){
mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
VALUES('$acc_id', 'Update bank name from`$db_payment_name` changed to `$updated_db_payment_name`', '$currentDateTime','product','$payment_id')");
}    

if($db_payment_number!=$updated_db_payment_number){
mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
VALUES('$acc_id', 'Update bank number from`$db_payment_number` changed to `$updated_db_payment_number`', '$currentDateTime','product','$payment_id')"); 
}   

if ($db_payment_status !== $updated_db_payment_status) {
    if ($updated_db_payment_status === "0") {
        $updated_db_payment_status_log = "Disabled bank $updated_db_payment_name";
    } else {
        $updated_db_payment_status_log = "Enabled bank $updated_db_payment_name";
    }

    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id)
    VALUES('$acc_id', '$updated_db_payment_status_log', '$currentDateTime','product','$payment_id')");
}

    // Add your log entries here
    echo "Record updated successfully";
} else {
    echo "Error updating mode_of_payment: " . $connections->error;
}

}


$connections->close();
?>
