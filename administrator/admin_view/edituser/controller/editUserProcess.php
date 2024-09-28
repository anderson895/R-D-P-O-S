<?php
include("../../../../connection.php");

$acc_code = $_POST["acc_code"];
date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$username = $_POST["username"];
$password = $_POST["password"];
$accountType = $_POST["accountType"];
$acc_id = $_POST["acc_id"];

print_r($_POST);

$get_record = mysqli_query($connections, "SELECT * FROM account WHERE acc_code = '$acc_code'");
$row = mysqli_fetch_assoc($get_record);

if ($row) {
    $db_acc_id = $row["acc_id"];
    $db_userImage = $row["emp_image"];
    $db_acc_username = $row["acc_username"];
    $db_acc_fname = $row["acc_fname"];
    $db_acc_lname = $row["acc_lname"];
    $db_acc_email = $row["acc_email"];
    $db_acc_type = $row["acc_type"];
    $db_acc_contact = $row["acc_contact"];

    $userImage = $db_userImage; // Initialize userImage with the existing value

    // Handle file upload
    if ($_FILES && $_FILES['userImage']['error'] === UPLOAD_ERR_OK) {
        $imagePath = '../../../../upload_img';
        $fileExtension = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
        $uniqueFilename = uniqid() . '.' . $fileExtension;
        $targetFile = $imagePath . '/' . $uniqueFilename;

        if (is_uploaded_file($_FILES['userImage']['tmp_name']) && move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile)) {
            // If there was an old image, delete it
            if ($db_userImage) {
                $existingImagePath = $imagePath . '/' . $db_userImage;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the existing image file
                }
            }
            $userImage = mysqli_real_escape_string($connections, $uniqueFilename);
        } else {
            $errorDetails = error_get_last();
            echo "Error: File upload failed - " . $errorDetails['message'];
            exit; // Exit the script if file upload fails
        }
    }

    // Prepare the update query based on whether the password is provided
    if ($password) {
        $hashedPassword = hash('sha256', $password);
        $updateQuery = "UPDATE account SET 
            acc_created = '$currentDateTime',
            acc_username = '$username',
            acc_password = '$hashedPassword',
            acc_fname = '$fname',
            acc_lname = '$lname',
            acc_type = '$accountType',
            acc_email = '$email',
            acc_contact = '$phone',
            emp_image = '$userImage'
        WHERE acc_code = '$acc_code'";
    } else {
        $updateQuery = "UPDATE account SET 
            acc_created = '$currentDateTime',
            acc_username = '$username',
            acc_fname = '$fname',
            acc_lname = '$lname',
            acc_type = '$accountType',
            acc_email = '$email',
            acc_contact = '$phone',
            emp_image = '$userImage'
        WHERE acc_code = '$acc_code'";
    }

    // Log the activity
    if ($userImage !== $db_userImage 
    || $db_acc_username !== $username
    || $fname !== $db_acc_fname 
    || $lname !== $db_acc_lname 
    || $email !== $db_acc_email 
    || $phone !== $db_acc_contact
    || $accountType !== $db_acc_type) {

        $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
        VALUES('$acc_id', 'Update $db_acc_fname $db_acc_lname`s information', '$currentDateTime', 'account', '$db_acc_id')";
        
        if (mysqli_query($connections, $logQuery) && mysqli_query($connections, $updateQuery)) {
            echo "Account updated successfully.";
        } else {
            echo "Error: " . mysqli_error($connections);
        }
    } else {
        if (mysqli_query($connections, $updateQuery)) {
            echo "Account updated successfully. No changes made to the image or information.";
        } else {
            echo "Error: " . mysqli_error($connections);
        }
    }
} else {
    echo "Error: Account with acc_code '$acc_code' not found.";
}
?>
